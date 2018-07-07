<?php

/**
 * Client filter form base class.
 *
 * @package    cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseClientFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'client_key'    => new sfWidgetFormFilterInput(),
      'client_secret' => new sfWidgetFormFilterInput(),
      'gateway_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gateway'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'          => new sfValidatorPass(array('required' => false)),
      'client_key'    => new sfValidatorPass(array('required' => false)),
      'client_secret' => new sfValidatorPass(array('required' => false)),
      'gateway_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Gateway'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('client_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();
    $this->widgetSchema->setFormFormatterName('_Base');    

    parent::setup();
  }

  public function getModelName()
  {
    return 'Client';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'name'          => 'Text',
      'client_key'    => 'Text',
      'client_secret' => 'Text',
      'gateway_id'    => 'ForeignKey',
    );
  }
}
