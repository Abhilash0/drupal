<?php

namespace Drupal\custom_simple_form\Plugin\rest\resource;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Psr\Log\LoggerInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Config\ConfigFactoryInterface;
/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "custom_simple_form_get_rest_resource",
 *   label = @Translation("Custom Simple Form get rest resource"),
 *   uri_paths = {
 *     "canonical" = "/custom-form"
 *   }
 * )
 */

class CustomSimpleFormGetRestResource extends ResourceBase {
  protected $config_factory;

  /**
   * {@inheritdoc}
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    array $serializer_formats,
    LoggerInterface $logger,
    ConfigFactoryInterface $config_factory) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);
    $this->config_factory = $config_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->getParameter('serializer.formats'),
      $container->get('logger.factory')->get('custom_simple_form'),
      $container->get('config.factory')
    );
  }
  
  

  /**
   * Responds to GET requests.
   *
   * Returns a list of bundles for specified entity.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws exception expected.
   */
  public function get() {
    $config = $this->config_factory->get('custom_simple_form.settings');

    // You must to implement the logic of your REST Resource here.
    // Use current user after pass authentication to validate access.
    // if (!$this->currentUser->hasPermission('access content')) {
    //   throw new AccessDeniedHttpException();
    // }
    // $entities = \Drupal::entityTypeManager()
    //   ->getStorage('node')
    //   ->loadMultiple();
    // foreach ($entities as $entity) {
    //   $result[$entity->id()] = $entity->title->value;
    // }
    $result['value'] = $config->get('passenger_payable_amount');
    $result['valuee'] = $config->get('driver_payable_amount_rupees');
        $response = new ResourceResponse($result);
    $response->addCacheableDependency($result);
    return $response;
  }

}