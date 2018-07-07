<?php

/**
 * Transaction filter form base class.
 *
 * @package    cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTransactionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'client_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Client'), 'add_empty' => true)),
      'gateway_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gateway'), 'add_empty' => true)),
      'status'      => new sfWidgetFormChoice(array('choices' => array('' => '', 'pending' => 'pending', 'paid' => 'paid', 'cancelled' => 'cancelled'))),
      'sum'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'currency'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'product'     => new sfWidgetFormFilterInput(),
      'description' => new sfWidgetFormFilterInput(),
      'hash'        => new sfWidgetFormFilterInput(),
      'url_success' => new sfWidgetFormFilterInput(),
      'url_cancel'  => new sfWidgetFormFilterInput(),
      'url_failure' => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'client_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Client'), 'column' => 'id')),
      'gateway_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Gateway'), 'column' => 'id')),
      'status'      => new sfValidatorChoice(array('required' => false, 'choices' => array('pending' => 'pending', 'paid' => 'paid', 'cancelled' => 'cancelled'))),
      'sum'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'currency'    => new sfValidatorPass(array('required' => false)),
      'product'     => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'hash'        => new sfValidatorPass(array('required' => false)),
      'url_success' => new sfValidatorPass(array('required' => false)),
      'url_cancel'  => new sfValidatorPass(array('required' => false)),
      'url_failure' => new sfValidatorPass(array('required' => false)),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('transaction_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();
    $this->widgetSchema->setFormFormatterName('_Base');    

    parent::setup();
  }

  public function getModelName()
  {
    return 'Transaction';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'client_id'   => 'ForeignKey',
      'gateway_id'  => 'ForeignKey',
      'status'      => 'Enum',
      'sum'         => 'Number',
      'currency'    => 'Text',
      'product'     => 'Text',
      'description' => 'Text',
      'hash'        => 'Text',
      'url_success' => 'Text',
      'url_cancel'  => 'Text',
      'url_failure' => 'Text',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}
