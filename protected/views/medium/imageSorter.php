<ul>
<?php
    $items = array();
    foreach ($wImages as $wImage):
        $items[$wImage->medium->medium_id.'#'.$wImage->priority] = '<img src="'.Yii::app()->baseUrl.$wImage->medium->url.'" width="60" />';
    endforeach;
    
    $this->widget('zii.widgets.jui.CJuiSortable',array(
        'id' => 'imageSort',
        'items' => $items,
        // additional javascript options for the JUI Sortable plugin
        'options'=>array(
            'change'=>'function( event, ui ) {alert(event);}',
            'delay'=>'300',
        ),
    ));
?>
</ul>