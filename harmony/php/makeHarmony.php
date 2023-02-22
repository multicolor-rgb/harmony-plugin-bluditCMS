<link rel="stylesheet" type="text/css" href="/bl-plugins/tinymce/css/tinymce_toolbar.css">
<script src="/bl-plugins/tinymce/tinymce/tinymce.min.js?version=5.10.5"></script>


<style>

.harmony-item{
    position: relative;
padding-top: 30px !important;
}

.closeHarmony{
position:absolute;
top:5px;
right:5px;
background:red !important;
border:none;
color:#fff;
}

</style>


<h3>Create Harmony</h3>

<button class="addHarmonyItem btn btn-primary mb-2">Add Item</button>
<hr>
<form method="post" action="<?php echo DOMAIN_ADMIN.'plugin/harmony';?>">
<input type="hidden" id="jstokenCSRF" name="tokenCSRF" value="<?php echo $tokenCSRF;?>">

<label for="title">Title Module</label>
<input type="text"  class="form-control mb-2" 

<?php 

if(isset($_GET['editharmony'])){

    echo 'value="'.$_GET['editharmony'].'"';

};
?>

id="title" name="title" pattern="[a-zA-Z0-9]+" required>

<p style="font-size:12px;color:red;">*Name without spacebar and special Characters</p>

<hr>

<select name="style" class="form-control mb-2 ">
    <option value="accordion"
	
	<?php 
	 if(isset($_GET['editharmony'])){
		$arrayItem = file_get_contents($this->phpPath().'harmonydb/'.$_GET['editharmony'].'.json');
		$jsonArray = json_decode($arrayItem);
		if($jsonArray->style == 'accordion'){
			echo 'selected';
		}
	 };
	?>
	
	>Accordion (bootstrap required)</option>
    <option value="tabs" 
	
	<?php 
	 if(isset($_GET['editharmony'])){
		$arrayItem = file_get_contents($this->phpPath().'harmonydb/'.$_GET['editharmony'].'.json');
		$jsonArray = json_decode($arrayItem);

		if($jsonArray->style == 'tabs'){
			echo 'selected';
		}
	 };
	?>
	
	>Tabs (bootstrap required)</option>
</select>


<div class="harmony-list">

<?php 

if(isset($_GET['editharmony'])){

    $arrayItem = file_get_contents($this->phpPath().'harmonydb/'.$_GET['editharmony'].'.json');
    $jsonArray = json_decode($arrayItem);



	if($jsonArray->harmonyTitle !==null){

		foreach($jsonArray->harmonyTitle as $key=>$value){

			echo '  <div class="harmony-item border p-2 mb-2">
		<button  class="closeHarmony btn btn-danger btn-sm" onclick="event.preventDefault();this.parentNode.remove()" >✕</button>
			
			<b class="mb-3 d-block">'.$value.'</b>
			<input type="text" class="form-control" value="'.$value.'"  name="harmonyTitle[]">
			<br>
			<p>Content</p>
			<textarea name="harmonyContent[]" id="jseditor" class="formcontrol tinycontent">'.$jsonArray->harmonyContent[$key].'</textarea>
			
			
			
			
			</div>';
		
			};

	};
   


}


;?>


</div>

<input type="submit" name="createHarmony" value="Save Harmony module" class="btn btn-primary">
</form>


<script>
    const addHarmonyItem = document.querySelector('.addHarmonyItem');
    const harmonyList = document.querySelector('.harmony-list');
 

    addHarmonyItem.addEventListener('click',(e)=>{
        e.preventDefault();

        harmonyList.insertAdjacentHTML('beforeend',`
        <div class="harmony-item border p-2 mb-2">

		<button  class="closeHarmony btn btn-danger btn-sm" onclick="event.preventDefault();this.parentNode.remove()" >✕</button>


        <b class="mb-3 d-block">Title</b>
        <input type="text" class="form-control"  name="harmonyTitle[]">
        <br>
        <p>Content</p>
        <textarea name="harmonyContent[]" class="formcontrol tinycontent"></textarea>
        </div>
        
        `);



    tinymce.init({
		selector: `.tinycontent`,
		element_format : "html",
		entity_encoding : "raw",
		skin: "oxide",
		schema: "html5",
		statusbar: false,
		menubar:false,
		branding: false,
		browser_spellcheck: true,
		pagebreak_separator: PAGE_BREAK,
		paste_as_text: true,
		remove_script_host: false,
		convert_urls: true,
		relative_urls: false,
		valid_elements: "*[*]",
		cache_suffix: "?version=5.10.5",
		
		plugins: ["code autolink image link pagebreak advlist lists textpattern table"],
		toolbar1: "formatselect bold italic forecolor backcolor removeformat | bullist numlist table | blockquote alignleft aligncenter alignright | link unlink pagebreak image code",
		toolbar2: "",
		language: "en",
		content_css: "/bl-plugins/tinymce/css/tinymce_content.css",
		codesample_languages: [],

 

	});
 
    }); 

</script>


<script>

tinymce.init({
		selector: '.tinycontent',
		element_format : "html",
		entity_encoding : "raw",
		skin: "oxide",
		schema: "html5",
		statusbar: false,
		menubar:false,
		branding: false,
		browser_spellcheck: true,
		pagebreak_separator: PAGE_BREAK,
		paste_as_text: true,
		remove_script_host: false,
		convert_urls: true,
		relative_urls: false,
		valid_elements: "*[*]",
		cache_suffix: "?version=5.10.5",
		
		plugins: ["code autolink image link pagebreak advlist lists textpattern table"],
		toolbar1: "formatselect bold italic forecolor backcolor removeformat | bullist numlist table | blockquote alignleft aligncenter alignright | link unlink pagebreak image code",
		toolbar2: "",
		language: "en",
		content_css: "/bl-plugins/tinymce/css/tinymce_content.css",
		codesample_languages: [],

 

	});

</script>

 