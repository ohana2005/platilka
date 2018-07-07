<?php

/**
 * ClientGatewayData form base class.
 * sfDoctrineFormGenerator 
 * @method ClientGatewayData getObject() Returns the current form's model object
 *
 * @package    cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
   
   
   
 
abstract class BaseClientGatewayDataForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
       
            
            
              'id'             => new sfWidgetFormInputHidden(),
      
        
        
       
            
            
              'client_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Client'), 'add_empty' => false)),
      
        
        
       
            
            
              'gateway_key'    => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'gateway_secret' => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'gateway_other'  => new sfWidgetFormInputText(),
      
        
        
    ));

    $this->setValidators(array(
            
              'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
                  
              'client_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Client'))),
                  
              'gateway_key'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
                  
              'gateway_secret' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
                  
              'gateway_other'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
          ));

    $this->widgetSchema->setNameFormat('client_gateway_data[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
    
           
           
     
         
  }

  public function getModelName()
  {
    return 'ClientGatewayData';
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
