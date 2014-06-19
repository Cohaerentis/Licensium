<?php

class ProjectController extends Controller {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'ajaxOnly + confirm, create, update, delete',
            array('EPrivilegesControlFilter - report', 'privileges' => self::PRIVILEGE_USER),
        );
    }

    /**
     * View user's project.
     */
    public function actionIndex() {
        $projects = Project::getByUser(Yii::app()->user->id);
        $this->render('index', array('projects' => $projects));
    }

    /**
     * Displays a particular project.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        sleep(2);
        if (Yii::app()->request->getIsAjaxRequest()) {
            $model = $this->loadModel($id);
            $this->renderAjaxHtml('view', array('model' => $model));
        } else {
            $projects = Project::getByUser(Yii::app()->user->id);
            $this->render('index', array('projects'     => $projects,
                                         'selected'     => $id));
        }
    }

    /**
     * Displays a report view of a particular project.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionReport($id, $code) {
        $model = Project::getById($id);
        if (!empty($model) && ($model->uuid == $code)) {
            if (!Yii::app()->user->isGuest) {
                Yii::app()->user->setFlash('warning', Yii::t('app', 'Tell user that he can share this ofuscate link with anyone, for example its license expert consultant'));
            }
            $this->render('report', array('model' => $model));
        } else {
            throw new CHttpException(404, Yii::t('app', 'Project does not exist.'));
        }
    }

    /**
     * Displays a particular project, for confirmation dialog
     * @param integer $id the ID of the model to be displayed
     */
    public function actionConfirm($id) {
        if (Yii::app()->request->getIsAjaxRequest()) {
            $model = $this->loadModel($id);
            $this->renderAjaxHtml('confirm', array('model' => $model));
        }
    }

    /**
     * Creates a new project.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        sleep(2);
        $model = new Project;

        // Case A: PostAjax, validate and save
        if (isset($_POST['Project'])) {
            $model->attributesClear($_POST['Project'], 'create');
            $model->attributes = $_POST['Project'];
            $model->user_id = Yii::app()->user->id;
            $model->createdate = time();
            $model->uuid = UUIDv4::create()->string;
            if ($model->save()) {
                Yii::app()->user->setFlash('success', Yii::t('app', 'Project "{name}" created', array('{name}' => e($model->name))));
                $this->renderAjaxRedirect($this->createUrl('/project/view',
                                                           array('id' => $model->id)));
            }
        }

        // Case B: GetAjax, show form
        // Show create form, with errors if no validated
        $this->renderAjaxHtml('form', array('model' => $model));
    }

    /**
     * Update a project
     */
    public function actionUpdate($id) {
        sleep(2);
        $model = $this->loadModel($id, true);

        // Case A: PostAjax, validate and save
        if (isset($_POST['Project'])) {
            $model->attributesClear($_POST['Project'], 'update');
            $model->attributes = $_POST['Project'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', Yii::t('app', 'Project "{name}" updated', array('{name}' => e($model->name))));
                $this->renderAjaxRedirect($this->createUrl('/project/view',
                                                           array('id' => $model->id)));
            }
        }

        // Case B: GetAjax, show form
        // Show update form, with errors if no validated
        $this->renderAjaxHtml('form', array('model' => $model));
    }

    /**
     * Deletes a project.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $model = $this->loadModel($id, true);
        $name = $model->name;
        if ($model->delete()) {
            Yii::app()->user->setFlash('success', Yii::t('app', 'Project "{name}" has been deleted', array('{name}' => e($name) )));
            $this->renderAjaxRedirect($this->createUrl('.'));
        }
        $this->renderAjaxError(Yii::t('app', 'While deleteting project "{name}"', array('{name}' => e($name) )));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @param boolean $nocache Read model from DB. True if this model will be modified
     * @return Center the loaded model
     * @throws CHttpException
     */
    public function loadModel($id, $nocache = false) {
        $model = Project::getById($id, $nocache);
        if ($model === null) {
            throw new CHttpException(404, Yii::t('app', 'Project does not exist.'));
        }
        if ($model->user_id != Yii::app()->user->id) {
            throw new CHttpException(401, Yii::t('app', 'You are not the owner of this project.'));
        }
        return $model;
    }
}
