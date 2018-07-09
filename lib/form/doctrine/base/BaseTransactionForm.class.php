<?php

/**
 * Transaction form base class.
 * sfDoctrineFormGenerator 
 * @method Transaction getObject() Returns the current form's model object
 *
 * @package    cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
   
   
   
 
abstract class BaseTransactionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
       
            
            
              'id'          => new sfWidgetFormInputHidden(),
      
        
        
       
            
            
              'client_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Client'), 'add_empty' => false)),
      
        
        
       
            
            
              'gateway_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gateway'), 'add_empty' => false)),
      
        
        
       
            
            
              'status'      => new sfWidgetFormChoice(array('choices' => array('pending' => 'pending', 'paid' => 'paid', 'cancelled' => 'cancelled'))),
      
        
        
       
            
            
              'sum'         => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'currency'    => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'product'     => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'description' => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'hash'        => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'objectid'    => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'params'      => new sfWidgetFormTextarea(),
      
        
        
       
            
            
              'url_success' => new sfWidgetFormTextarea(),
      
        
        
       
            
            
              'url_cancel'  => new sfWidgetFormTextarea(),
      
        
        
       
            
            
              'url_failure' => new sfWidgetFormTextarea(),
      
        
        
       
            
            
              'created_at'  => new sfWidgetFormDateTime(),
      
        
        
       
            
            
              'updated_at'  => new sfWidgetFormDateTime(),
      
        
        
    ));

    $this->setValidators(array(
            
              'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
                  
              'client_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Client'))),
                  
              'gateway_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Gateway'))),
                  
              'status'      => new sfValidatorChoice(array('choices' => array(0 => 'pending', 1 => 'paid', 2 => 'cancelled'), 'required' => false)),
                  
              'sum'         => new sfValidatorNumber(),
                  
              'currency'    => new sfValidatorString(array('max_length' => 32)),
                  
              'product'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
                  
              'description' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
                  
              'hash'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
                  
              'objectid'    => new sfValidatorInteger(array('required' => false)),
                  
              'params'      => new sfValidatorString(array('required' => false)),
                  
              'url_success' => new sfValidatorString(array('required' => false)),
                  
              'url_cancel'  => new sfValidatorString(array('required' => false)),
                  
              'url_failure' => new sfValidatorString(array('required' => false)),
                  
              'created_at'  => new sfValidatorDateTime(),
                  
              'updated_at'  => new sfValidatorDateTime(),
          ));

    $this->widgetSchema->setNameFormat('transaction[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
    
           
         unset($this['created_at'], $this['updated_at']);
           
     
         
  }

  public function getModelName()
  {
    return 'Transaction';
  }
    public function updateObject($values = null)
    {
        $object = parent::updateObject($values);
                return $object;
    }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();
    foreach($this->embeddedTextBlocks as $block_name){
        $TextBlock = Q::c('TextBlock', 'b')
            ->where('b.special_mark = ?', $block_name)
            ->fetchOne();
        if($TextBlock){
            $this->setDefault($block_name, $TextBlock->text);
        }
    }    
      }
  

  protected function doSave($con = null)
  {
    parent::doSave($con);
    
    foreach($this->embeddedTextBlocks as $block_name){
        $TextBlock = Q::c('TextBlock', 'b')
            ->where('b.special_mark = ?', $block_name)
            ->fetchOne();
        if($TextBlock){
            $TextBlock->text = $this->values[$block_name];
            $TextBlock->save();
        }
    }
  }



}
