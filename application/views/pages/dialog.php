<? if($this->getContent() !== null):?>
    <? foreach($this->getContent() as $key=>$value){ ?>
        <div class="content">
            <? echo $value ?>
        </div>
    <? } ?>
<? endif;?>