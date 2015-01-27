<?php

/*
 * This file is part of the Nm Adfly package.
 *
 * (c) Mohammed Rhamnia <https://github.com/rmed19/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nm\AdflyBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;

/**
 * Adfly manager
 * 
 * @author Mohammed Rhamnia <rhamnia@nm-development.com>
 */
class AdflyManager
{

    /**
     * adfly api parametrs
     * @var array 
     */
    protected $adflyParams;

    /**
     * construct
     * 
     * @param Symfony\Component\DependencyInjection\ContainerInterface $container 
     */
    public function __construct(Container $container)
    {
        $this->adflyParams = $container->getParameter('nm_adfly_shorter');
    }

    /**
     * Adfly Url Shortener Methode
     * 
     * @param string $url http://www.google.com
     * 
     * @return string $url
     * 
     * @throws \Exporter\Exception\InvalidMethodCallException
     */
    public function adflyIt($url)
    {
        $query = array(
            'key' => $this->adflyParams['key'],
            'uid' => $this->adflyParams['uid'],
            'advert_type' => $this->adflyParams['advert_type'],
            'domain' => $this->adflyParams['domain'],
            'url' => $url
        );

        $api = $this->adflyParams['url'] . "?" . http_build_query($query);

        $link = file_get_contents($api);
        $data = json_decode($link);
        if ($data && isset($data->errors)) {
            $error = $data->errors[0];
            throw new \Exporter\Exception\InvalidMethodCallException($error->msg, $error->code);
        }

        return $link;
    }

}
