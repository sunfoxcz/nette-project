<?php

namespace App\Presenters;

use App\Forms\SignInFormFactory;


final class SignPresenter extends BasePresenter
{
    /**
     * @var SignInFormFactory
     * @inject
     */
    public $signInFormFactory;

    public function createComponentSignInForm()
    {
        $this->signInFormFactory->onLoggedIn[] = function($user) {
            $this->redirect('Homepage:');
        };
        return $this->signInFormFactory->create();
    }

    public function actionOut()
    {
        $this->getUser()->logout();
        $this->redirect('Homepage:');
    }
}
