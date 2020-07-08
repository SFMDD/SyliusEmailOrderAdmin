<?php

namespace FMDD\SyliusEmailOrderAdminPlugin\Command;

use Doctrine\ORM\NonUniqueResultException;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\OrderRepository;
use Sylius\Component\Mailer\Sender\SenderInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\Translation\TranslatorInterface;


class EmailOrderAdminCommand extends Command
{
    /** @var SenderInterface $sender */
    private $sender;
    /** @var OrderRepository $repositoryOrder */
    private $repositoryOrder;
    /** @var array $emailsAdmin */
    private $emailsAdmin;
    /** @var TranslatorInterface $translator */
    private $translator;

    /**
     * EmailOrderAdminCommand constructor.
     * @param SenderInterface $sender
     * @param OrderRepository $orderRepository
     * @param array $emailsAdmin
     * @param TranslatorInterface $translator
     */
    public function __construct(SenderInterface $sender, OrderRepository $orderRepository, array $emailsAdmin, TranslatorInterface $translator)
    {
        $this->sender = $sender;
        $this->repositoryOrder = $orderRepository;
        $this->emailsAdmin = $emailsAdmin;
        $this->translator = $translator;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('fmdd:email:order:admin')
            ->setDescription('Test send an admin order e-mail')
            ->addOption('locale', "l", InputOption::VALUE_OPTIONAL, "Option locale, for translation.");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        if (!is_null($locale = $input->getOption('locale'))) {
            $this->translator->setLocale($locale);
        }


        $orders = $this->repositoryOrder->findBy(array('checkoutState' => 'completed'));
        $order = $orders[array_rand($orders)];

        if (!is_null($order)) {
            $this->sender->send('order_payed', $this->emailsAdmin, ['order' => $order]);
        } else {
            $output->writeln('<error>You need to have at least one order in the database.</error>');
        }

        $output->writeln(sprintf('Finished execution, list of email admin: %s', implode(',', $this->emailsAdmin)));
    }
}
