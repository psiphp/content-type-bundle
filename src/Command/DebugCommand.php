<?php

namespace Psi\Bundle\ContentType\Command;

use Psi\Component\ContentType\Field;
use Psi\Component\ContentType\FieldLoader;
use Psi\Component\ContentType\FieldRegistry;
use Psi\Component\ContentType\OptionsResolver\FieldOptionsResolver;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\OptionsResolver\Options;

class DebugCommand extends Command
{
    private $fieldRegistry;
    private $fieldLoader;

    public function __construct(
        FieldRegistry $registry,
        FieldLoader $fieldLoader
    ) {
        parent::__construct();
        $this->fieldRegistry = $registry;
        $this->fieldLoader = $fieldLoader;
    }

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->setName('psi:debug:content-type:field');
        $this->addArgument('field', InputArgument::OPTIONAL, 'Show information for specific field');
        $this->setDescription('List and inspect content type fields');
        $this->setHelp(<<<'EOT'
Invoke with no arguments in order to list all available fields:

    $ %command.full_name%

Specify a field name in order to show more information:

    $ %command.full_name% text
EOT
        );
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $key = $input->getArgument('field');

        if (null === $key) {
            return $this->listFields($output);
        }

        $field = $this->fieldLoader->load($key, []);

        return $this->showField($output, $key, $field);
    }

    private function listFields(OutputInterface $output)
    {
        $output->writeln('<info>List of available fields:</info>');
        $table = new Table($output);
        $table->setStyle('compact');
        foreach ($this->fieldRegistry->all() as $key => $field) {
            $table->addRow([
                sprintf('<comment>%s</comment>', $key),
                get_class($field),
            ]);
        }

        $table->render();
        $output->writeln('// Specify a field for more information');
    }

    private function showField(OutputInterface $output, $key, Field $field)
    {
        $output->writeln('<info>Field: </info>' . $key);
        $output->write(PHP_EOL);
        $output->write('<comment>View: </comment>');
        $output->writeln($field->getViewType());

        $output->write('<comment>Form: </comment>');
        $output->writeln($field->getFormType());
        $output->write('<comment>Storage type: </comment>');
        $output->writeln($field->getStorageType());

        $output->write('<comment>Defined options: </comment>');
        $options = new FieldOptionsResolver();
        $field->getInnerField()->configureOptions($options);
        $options->getDefinedOptions()
            ? $output->write(implode(', ', $options->getDefinedOptions()))
            : $output->write('No defined options');

        $output->write(PHP_EOL);
    }
}
