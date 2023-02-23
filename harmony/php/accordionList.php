<style>
    .harmony-file{
        display:grid;
       align-items: center;
       grid-template-columns: 1fr 1fr 120px;
        width:100%;
        margin-top: 10px;
        border-bottom:solid 1px #ddd;
        padding-bottom: 10px;
        padding-left: 5px;
        padding-right: 5px;
    }
</style>

<h3>Harmony modules list</h3>


<div class="my-3">
<a href="<?php echo DOMAIN_ADMIN.'plugin/harmony?addHarmony';?>" class="btn btn-primary ">Add new</a>
<a href="<?php echo DOMAIN_ADMIN.'plugin/harmony?helpHarmony';?>" class="btn btn-primary ">Help</a>
</div>


<hr>

<ul class="m-0 p-0">


<?php 
foreach(glob($this->phpPath().'harmonydb/*.json') as $file){

    $name =pathinfo($file)['filename'];


    echo '
<li class="harmony-file">
    <h5 class="m-0 p-0">'.$name.'</h5>

    <div>


     
        [% harmony='.$name.' %]
     
    </div>


    <div class="harmony-file-btn">

    <a class="btn btn-primary" href="'.DOMAIN_ADMIN.'plugin/harmony?editharmony='.$name.'">Edit</a>
    <a class="btn btn-danger" onclick="return confirm(`Are you sure you want to delete this item?`);" href="'.DOMAIN_ADMIN.'plugin/harmony?deleteharmony='.$name.'">Delete</a>

    </div>

</li>';

}
;?>


</ul>

