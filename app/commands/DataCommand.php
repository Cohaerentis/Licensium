<?php

class DataCommand extends CConsoleCommand {
    public function __construct($name, $runner) {
        parent::__construct($name, $runner);
    }

    public function actionIndex() {
        wrout('Database initialization commands, type --help for a list of commands');
    }

    public function actionLicensesLoad($csvfile) {
        wrout('Loading licenses with CSV file ...');
        wrout('File = ' . var_export($csvfile, true));
        if (file_exists($csvfile)) {
            $this->csvLicensesLoad($csvfile);
        } else {
            wrout("ERROR : CSV file '$csvfile' not found");
            exit(1);
        }
    }

    public function actionCompatibilityLoad($csvfile) {
        wrout('Loading licenses compatibility with CSV file ...');
        wrout('File = ' . var_export($csvfile, true));
        if (file_exists($csvfile)) {
            $this->csvCompatibilityLoad($csvfile);
        } else {
            wrout("ERROR : CSV file '$csvfile' not found");
            exit(1);
        }
    }

    public function csvLicensesLoad($csvfile) {
        $urlvalidator = new CUrlValidator();
        $csv = new CsvImporter($csvfile, true, ',');
        if (!empty($csv)) {
            $rows = $csv->get();
            wrout('# Licenses in CSV : ' . count($rows));
            $i = 0;
            foreach ($rows as $row) {
                $i++;
                if (!empty($row['Label'])) {
                    $label = strtolower(trim($row['Label']));
                    $current = License::model()->find('label = :label', array('label' => $label));
                    if (!empty($current)) {
                        wrout("[$i] (#) License '{$label}' found, updating.");
                    } else {
                        wrout("[$i] (+) License '{$label}' not found, adding.");
                        $current = new License();
                        $current->label = $label;
                    }
                    if (!empty($row['Name']))                $current->name             = trim($row['Name']);
                    if (!empty($row['Description']))         $current->description      = trim($row['Description']);
                    if (!empty($row['Url'])) {
                        $url = trim($row['Url']);
                        if ($urlvalidator->validateValue($url)) $current->url           = $url;
                        else wrout("[$i] (?) License '{$label}' has an invalid URL = {$url}");
                    }
                    if (!$current->save()) {
                        wrout("[$i] ERROR: Saving license. " . var_export($current->getErrors(), true));
                    }
                } else {
                    wrout("[$i] (?) License doesn't have 'Label' column found, ignoring. Row = " . var_export($row, true));
                }
            }
        } else {
            wrout("ERROR : CSV file '$csvfile' is not readable");
        }
    }

    public function csvCompatibilityLoad($csvfile) {
        // TODO
        $csv = new CsvImporter($csvfile, true, ',');
        if (!empty($csv)) {
            $rows = $csv->get();
            wrout('# Licenses compatibility in CSV : ' . count($rows));
            $i = 0;
            foreach ($rows as $row) {
                $i++;
                if (!empty($row['Right']) && !empty($row['Left']) &&
                    !empty($row['TypeRight']) && !empty($row['TypeLeft'])) {
                    $leftlabel = strtolower(trim($row['Left']));
                    $rightlabel = strtolower(trim($row['Right']));
                    $typeleft = strtoupper(trim($row['TypeLeft']));
                    $typeright = strtoupper(trim($row['TypeRight']));
                    $left = License::model()->find('label = :label', array('label' => $leftlabel));
                    $right = License::model()->find('label = :label', array('label' => $rightlabel));
                    if (empty($left) || empty($right)) {
                        if (empty($left)) wrout("[$i] (?) License '{$leftlabel}' doesn't exist, ignoring.");
                        if (empty($right)) wrout("[$i] (?) License '{$rightlabel}' doesn't exist, ignoring.");
                        continue;
                    }
                    if ( ($typeleft != 'S') && ($typeleft != 'D')) {
                        wrout("[$i] (?) License '{$leftlabel}' has an invalid type '{$typeleft}', ignoring.");
                        continue;
                    }
                    if ( ($typeright != 'S') && ($typeright != 'D')) {
                        wrout("[$i] (?) License '{$rightlabel}' has an invalid type '{$typeright}', ignoring.");
                        continue;
                    }
                    $current = Compatible::model()->find(
                        'left_id = :lid AND right_id = :rid AND typeleft = :tleft AND typeright = :tright',
                        array('lid' => $left->id, 'rid' => $right->id, 'tleft' => $typeleft, 'tright' => $typeright));
                    $inverse = Compatible::model()->find(
                        'left_id = :rid AND right_id = :lid AND typeleft = :tright AND typeright = :tleft',
                        array('lid' => $left->id, 'rid' => $right->id, 'tleft' => $typeleft, 'tright' => $typeright));
                    if (!empty($current)) {
                        wrout("[$i] (#) Compatibility '{$leftlabel}-{$typeleft} vs {$rightlabel}-{$typeright}' found, updating.");
                    } else {
                        wrout("[$i] (+) Compatibility '{$leftlabel}-{$typeleft} vs {$rightlabel}-{$typeright}' not found, adding.");
                        $current = new Compatible();
                        $current->left_id = $left->id;
                        $current->right_id = $right->id;
                        $current->typeleft = $typeleft;
                        $current->typeright = $typeright;
                    }
                    if (empty($inverse)) {
                        $inverse = new Compatible();
                        $inverse->left_id = $right->id;
                        $inverse->right_id = $left->id;
                        $inverse->typeleft = $typeright;
                        $inverse->typeright = $typeleft;
                    }
                    $status = 0;
                    if (!empty($row['Compatibility'])) {
                        $comp = strtolower(trim($row['Compatibility']));
                        if ( (is_numeric($comp) && ($comp > 0)) ||
                             (is_string($comp) &&
                              (($comp == 'si') || ($comp == 'sí') || ($comp == 'yes')) ) ) {
                            $status = 1;
                        }
                    }
                    $current->status = $status;
                    $inverse->status = $status;
                    if (!$current->save()) {
                        wrout("[$i] ERROR: Saving compatible record. " . var_export($current->getErrors(), true));
                    }
                    if ( !( ($current->left_id == $inverse->left_id) && ($current->right_id == $inverse->right_id) &&
                          ($current->typeleft == $inverse->typeleft) && ($current->typeright == $inverse->typeright) ) ) {
                        // AEA - Avoid to save the same registry
                        if (!$inverse->save()) {
                            wrout("[$i] ERROR: Saving compatible record. " . var_export($inverse->getErrors(), true));
                        }
                    }
                } else {
                    wrout("[$i] (?) Compatibility doesn't have 'Left', 'Right', 'TypeLeft' or 'TypeRight' column, ignoring. Row = " . var_export($row, true));
                }
            }
        } else {
            wrout("ERROR : CSV file '$csvfile' is not readable");
        }
    }

}