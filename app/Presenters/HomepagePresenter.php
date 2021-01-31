<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nettrine\ORM\EntityManagerDecorator;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{
    /**
     * @var EntityManagerDecorator
     */
    private $em;

    public function __construct(EntityManagerDecorator $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    public function actionDefault(): void
    {
        $this->template->mysqlVersion = $this->em->getConnection()
            ->executeQuery('SELECT VERSION()')
            ->fetchOne();
    }
}
