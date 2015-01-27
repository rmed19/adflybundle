Using NmAdflyBundle
===================

Welcome to NmAdflyBundle - a Symfony bundle to make short url using Adfly api 

Installation
------------

Step 1: Download the Bundle
~~~~~~~~~~~~~~~~~~~~~~~~~~~

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

.. code-block:: bash

    $ composer require nmdev/adflybundle

This command requires you to have Composer installed globally, as explained
in the ``installation chapter``_ of the Composer documentation.

Step 2: Enable the Bundle
~~~~~~~~~~~~~~~~~~~~~~~~~

Then, enable the bundle by adding the following line in the ````app/AppKernel.php````
file of your project:

.. code-block:: php

    <?php
    // app/AppKernel.php

    // ...
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                // ...

                new Nm\AdflyBundle\NmAdflyBundle(),
            );

            // ...
        }

        // ...
    }

Step 3: Configure the bundle
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To use Adfly API at first you need to get your API key and your user id. If you are a Adfly member you can get these by following way.

Go to tools-api_. 

.. _tools-api: http://adf.ly/publisher/tools#tools-api

.. code-block:: yaml

    # app/config/config.yml
    nm_adfly:
        key : ADDFLY_API_KEY #Your api key
        uid : USER_ID #your user id
        advert_type : int #(optional) int || banner 
        domain : adf.ly #(optional) adf.ly || q.gs

Usage
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: php
// Acme\MainBundle\Controller\ArticleController.php

    public function updateAction($id)
    {
        $em = $this->getEntityManager();
        $article = $em->getRepository("AcmeMainBundle:Article")->find($id);
        $editForm = $this->createEditForm($document);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            $showLink = $this->generateUrl("article_show", array('slug' => $post->getId()), true);

            $adflyLink = $this->get('nm_adfly.manager')->adflyIt($showLink);
            $article->setAdflyLink($adflyLink);

            $this->persistAndFlush($article);

            return $this->redirect($showLink);
        }

        return array(
            'article' => $article,
            'edit_form' => $editForm->createView()
        );
    }