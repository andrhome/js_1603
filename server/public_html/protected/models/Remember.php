<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class Remember extends CFormModel
{
    public $email;

    public function rules()
    {
        return array(
            // username and password are required
            array('email', 'required'),
            array('email', 'email'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'rememberMe'=>'Remember me next time',
        );
    }
}
