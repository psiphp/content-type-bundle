<?php

namespace Psi\Bundle\ContentType\Command;

use Psi\Component\ContentType\FieldInterface;
use Psi\Component\ContentType\FieldRegistry;
use Psi\Component\ContentType\Mapping\CompoundMapping;
use Psi\Component\ContentType\MappingBuilder;
use Psi\Component\ContentType\MappingBuilderCompound;
use Psi\Component\ContentType\MappingInterface;
use Psi\Component\ContentType\MappingRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DebugCommand extends Command
{
    private $fieldRegistry;
    private $mappingRegistry;

    public function __construct(
        FieldRegistry $registry,
        MappingRegistry $mappingRegistry
    ) {
        parent::__construct();
        $this->fieldRegistry = $registry;
        $this->mappingRegistry = $mappingRegistry;
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

        $field = $this->fieldRegistry->get($key);

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

    private function showField(OutputInterface $output, $key, FieldInterface $field)
    {
        $output->writeln('<info>Field: </info>' . $key);
        $output->write(PHP_EOL);
        $output->writeln('<comment>// View</comment>');
        $output->writeln($field->getViewType());
        $output->write(PHP_EOL);

        $output->writeln('<comment>// Form</comment>');
        $output->writeln($field->getFormType());
        $output->write(PHP_EOL);

        $output->writeln('<comment>// Mapping</comment>');
        $mapping = new MappingBuilder($this->mappingRegistry);
        $mapping = $field->getMapping($mapping);

        if ($mapping instanceof MappingBuilderCompound) {
            $mapping = $mapping->getCompound();
        }

        $this->showMapping($output, $mapping);
        $output->write(PHP_EOL);

        $output->writeln('<comment>// Default options</comment>');
        $options = new OptionsResolver();
        $field->configureOptions($options);
        $options = $options->resolve([]);
        $this->showOptions($output, $options);
    }

    private function showMapping(OutputInterface $output, MappingInterface $mapping)
    {
        if (false === $mapping instanceof CompoundMapping) {
            $output->writeln(get_class($mapping));

            return;
        }

        $table = new Table($output);
        foreach ($mapping as $key => $child) {
            $table->addRow([$key, get_class($child)]);
        }

        $table->render();
    }

    private function showOptions(OutputInterface $output, array $options)
    {
        if (empty($options)) {
            $output->writeln('No default options');

            return;
        }

        $table = new Table($output);

        foreach ($options as $key => $value) {
            $table->addRow([$key, $value]);
        }

        $table->render();
    }
}
