<?php

namespace AppBundle\Twig\Extension;

class AppExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app';
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('diff', array($this, 'diffFilter')),
            new \Twig_SimpleFilter('published', array($this, 'isPublished'), ['is_safe' => ['html']]),
        );
    }

    public function diffFilter(\DateTime $dateTime)
    {
        //$interval->format('%R%a jours');  //date("m/d/Y")
        $date1 = new \DateTime("now");
        $interval = $date1->diff($dateTime);
        if ($interval->y > 0) {
            $string = 'il y a '.$interval->y.'ans';
        } elseif ($interval->m > 0) {
            $string = 'il y a '.$interval->m.'mois';
        } elseif ($interval->d > 0) {
            if ($interval->d > 1) {
                $string = 'il y a '.$interval->d.'jours';
            } else {
                $string = 'hier';
            }
        } else {
            $string = 'il y a '.$interval->h.'h, '.$interval->i.'min, '.$interval->s.'s';
        }
        return $string;
    }

    /**
     * @param int $publishedValue (0|1)
     */
    public function isPublished($publishedValue)
    {
        if ($publishedValue) {
            return "<span class='label label-success'>oui</span>";
        } else {
            return "<span class='label label-default'>non</span>";
        }
    }
}
