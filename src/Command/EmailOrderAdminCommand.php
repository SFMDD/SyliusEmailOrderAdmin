<?php

namespace FMDD\SyliusEmailOrderAdminPlugin\Command;

use Sylius\Bundle\CoreBundle\Doctrine\ORM\OrderRepository;
use Sylius\Component\Mailer\Sender\Sender;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;

class EmailOrderAdminCommand extends Command {

    /**
     * @var Sender
     */
    private $sender;
    /**
     * @var OrderRepository
     */
    private $repositoryOrder;
    private $emailsAdmin;

    public function __construct(Sender $sender, OrderRepository $orderRepository, array $emailsAdmin)
    {
        $this->sender = $sender;
        $this->repositoryOrder = $orderRepository;
        $this->emailsAdmin = $emailsAdmin;
        parent::__construct();
    }

    protected function configure(): void {
        $this
            ->setName('email:order:admin')
            ->setDescription('');
    }

    protected function execute(InputInterface $input, OutputInterface $output) : void {
        $order = $this->repositoryOrder->findAll();

        if(!empty($order))
            $this->sender->send('order_payed',
                $this->emailsAdmin, ['order' => $order[0]]);
        else
            $output->writeln("Erreur you need to have one order");
    }
}
