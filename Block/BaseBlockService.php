<?php
/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Bundle\Sonata\PageBundle\Block;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * PageExtension
 *
 *
 * @author     Thomas Rabaix <thomas.rabaix@sonata-project.org>
 */
abstract class BaseBlockService extends ContainerAware
{
    protected $name;

    abstract public function defineBlockGroupField($field_group, $block);

    abstract public function validateBlock($block);

    public function getViewTemplate()
    {
        return sprintf('Sonata/PageBundle:Block:block_%s.twig', str_replace('.', '_', $this->getName()));
    }

    public function getEditTemplate()
    {
        return sprintf('Sonata/PageBundle:BlockAdmin:block_%s_edit.twig', str_replace('.', '_', $this->getName()));
    }

    public function render($template, $params = array())
    {

        return $this
            ->container->get('templating')
            ->render($template, $params);
    }

    public function execute($block, $page)
    {

        return $this->render($block->getTemplate(), array(
             'block' => $block,
             'page'  => $page
        ));
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}