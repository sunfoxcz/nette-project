<?php

namespace App\Presenters;

use App\Forms\SignInFormFactory;
use Nette;


final class SignPresenter extends Nette\Application\UI\Presenter
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
