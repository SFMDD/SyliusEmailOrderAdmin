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
            ->setName('fmdd:email:order:admin')
            ->setDescription('Test send an admin order e-mail');
    }

    protected function execute(InputInterface $input, OutputInterface $output) : void {
        $order = $this->repositoryOrder->createQueryBuilder('p')->setMaxResults(1)->getQuery()->getOneOrNullResult();

        if (!is_null($order)) {
            $this->sender->send('order_payed', $this->emailsAdmin, ['order' => $order]);
        }
        else {
            $output->writeln('<error>You need to have at least one order in the database.</error>');
        }

        $output->writeln(sprintf('Finished execution, list of email admin: %s', implode(',', $this->emailsAdmin)));
    }
}
