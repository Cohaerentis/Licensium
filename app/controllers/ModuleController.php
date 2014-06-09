<?php

class ModuleController extends Controller {

    protected $project = null;

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'ajaxOnly + confirm, create, update, delete',
            array('EPrivilegesControlFilter - public', 'privileges' => self::PRIVILEGE_USER),
        );
    }

    /**
     * View project's modules.
     */
    public function actionIndex($projectid) {
        $project = $this->loadProject($projectid);
        $modules = Module::getByProject($projectid);
        $this->render('index', array('modules'     => $modules,
                                     'project'     => $project));
    }

    /**
     * Displays a particular module.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($projectid, $id) {

        if (Yii::app()->request->getIsAjaxRequest()) {
            $model = $this->loadModel($id, $projectid);
            $this->renderAjaxHtml('view', array('model' => $model));
        } else {
            $project = $this->loadProject($projectid);
            $modules = Module::getByProject($projectid);
            $this->render('index', array('modules'     => $modules,
                                         'selected'    => $id,
                                         'project'     => $project));
        }
    }

    /**
     * Displays a particular project, for confirmation dialog
     * @param integer $id the ID of the model to be displayed
     */
    public function actionConfirm($projectid, $id) {
        // This is ajaxOnly
        $model = $this->loadModel($id, $projectid);
        $this->renderAjaxHtml('confirm', array('model' => $model,
                                               'projectid' => $projectid));
    }

    protected function priorityChange($change, $projectid, $id) {
        $model = $this->loadModel($id, $projectid);
        if (!$model->priorityChange($change, $this->project)) {
            $msg = Yii::t('app', 'Error while changing module priority.');
            throw new CHttpException(500, $msg);
        }


    }

    public function actionUp($projectid, $id) {
        $this->priorityChange('up', $projectid, $id);
        $this->redirect("/module/view/projectid/$projectid/id/$id");
    }

    public function actionDown($projectid, $id) {
        $this->priorityChange('down', $projectid, $id);
        $this->redirect("/module/view/projectid/$projectid/id/$id");
    }

    /**
     * Creates a new project.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($projectid) {
        $model = new Module;
        $project = $this->loadProject($projectid);

        // Case A: PostAjax, validate and save
        if (isset($_POST['Module'])) {
            $model->attributesClear($_POST['Module'], 'create');
            $model->attributes = $_POST['Module'];
            $model->project_id = $projectid;
            $model->createdate = time();
            $model->priority   = $project->lastPriority() + 1;
            if ($model->save()) {
                Yii::app()->user->setFlash('success', Yii::t('app', 'Module "{name}" created. TODO : Tell user, this module has now last priority', array('{name}' => e($model->name))));
                $this->renderAjaxRedirect($this->createUrl('/module/view',
                                                           array('id'        => $model->id,
                                                                 'projectid' => $model->project_id)));
            }
        }

        // Case B: GetAjax, show form
        // Show create form, with errors if no validated
        $this->renderAjaxHtml('form', array('model' => $model,
                                            'projectid' => $projectid));
    }

    /**
     * Update a project
     */
    public function actionUpdate($projectid, $id) {
        $model = $this->loadModel($id, $projectid, true);

        // Case A: PostAjax, validate and save
        if (isset($_POST['Module'])) {
            $model->attributesClear($_POST['Module'], 'update');
            $model->attributes = $_POST['Module'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', Yii::t('app', 'Module "{name}" updated', array('{name}' => e($model->name))));
                $this->renderAjaxRedirect($this->createUrl('/module/view',
                                                           array('id'        => $model->id,
                                                                 'projectid' => $model->project_id)));
            }
        }

        // Case B: GetAjax, show form
        // Show update form, with errors if no validated
        $this->renderAjaxHtml('form', array('model' => $model,
                                            'projectid' => $projectid));
    }

    /**
     * Deletes a project.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($projectid, $id) {
        $model = $this->loadModel($id, $projectid, true);
        $name = $model->name;
        if ($model->delete()) {
            Yii::app()->user->setFlash('success', Yii::t('app', 'Module "{name}" has been deleted', array('{name}' => e($name) )));
            $this->renderAjaxRedirect($this->createUrl('/module/index',
                                                       array('projectid' => $projectid)));
        }
        $this->renderAjaxError(Yii::t('app', 'While deleteting module "{name}"', array('{name}' => e($name) )));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @param boolean $nocache Read model from DB. True if this model will be modified
     * @return Center the loaded model
     * @throws CHttpException
     */
    public function loadModel($id, $projectid, $nocache = false) {
        $project = $this->loadProject($projectid);
        $model   = Module::getById($id, $nocache);
        if ($model === null) {
            $msg = Yii::t('app', 'Module does not exist.');
            if (Yii::app()->request->getIsAjaxRequest()) $this->renderAjaxError($msg);
            else                                         throw new CHttpException(404, $msg);
        }
        if ($model->project_id != $projectid) {
            $msg = Yii::t('app', 'This module is not belong to selected project.');
            if (Yii::app()->request->getIsAjaxRequest()) $this->renderAjaxError($msg);
            else                                         throw new CHttpException(401, $msg);
        }
        return $model;
    }

    public function loadProject($projectid) {
        // Static cache
        if (!empty($this->project) && ($this->project->id == $projectid)) return $this->project;

        $project = Project::getById($projectid);

        if (empty($project)) {
            $msg = Yii::t('app', 'Project does not exist.');
            if (Yii::app()->request->getIsAjaxRequest()) $this->renderAjaxError($msg);
            else                                         throw new CHttpException(404, $msg);
        }
        if ($project->user_id != Yii::app()->user->id) {
            $msg = Yii::t('app', 'You are not the owner of this project.');
            if (Yii::app()->request->getIsAjaxRequest()) $this->renderAjaxError($msg);
            else                                         throw new CHttpException(401, $msg);
        }
        $this->project = $project;
        return $project;
    }
}
