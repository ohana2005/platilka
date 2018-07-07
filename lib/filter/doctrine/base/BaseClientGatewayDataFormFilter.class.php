<?php

/**
 * ClientGatewayData filter form base class.
 *
 * @package    cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseClientGatewayDataFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'client_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Client'), 'add_empty' => true)),
      'gateway_key'    => new sfWidgetFormFilterInput(),
      'gateway_secret' => new sfWidgetFormFilterInput(),
      'gateway_other'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'client_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Client'), 'column' => 'id')),
      'gateway_key'    => new sfValidatorPass(array('required' => false)),
      'gateway_secret' => new sfValidatorPass(array('required' => false)),
      'gateway_other'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('client_gateway_data_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();
    $this->widgetSchema->setFormFormatterName('_Base');    

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClientGatewayData';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'client_id'      => 'ForeignKey',
      'gateway_key'    => 'Text',
      'gateway_secret' => 'Text',
      'gateway_other'  => 'Text',
    );
  }
}
