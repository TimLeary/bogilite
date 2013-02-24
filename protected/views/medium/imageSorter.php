<ul>
<?php
    $items = array();
    foreach ($wImages as $wImage):
        $items[$wImage->medium->medium_id] = '<img src="'.Yii::app()->baseUrl.$wImage->medium->url.'" width="60" />';
    endforeach;
    
    $this->widget('zii.widgets.jui.CJuiSortable',array(
        'id' => 'imageSort',
        'items' => $items,
        // additional javascript options for the JUI Sortable plugin
        'options'=>array(
            //'start' => "js:function(){window.old_position = $(this).sortable('toArray');}",
            'update' => "js:function(){
                var sortObj = new Object();
                sortObj.newOrder = $(this).sortable('toArray');
                console.log(JSON.stringify(sortObj));
                
                $.ajax({
                    url: '".Yii::app()->createUrl('medium/changeSort',array('areaId'=>$areaId,'objectId' =>$objectId))."&newOrderStr='+JSON.stringify(sortObj),
                    success: function(data) {
                        refreshSorter();
                    }
                });
            }",
            'delay'=>'300',
        ),
    ));
?>
</ul>