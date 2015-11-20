@extends('layouts.master')

@section('content')

@if(Session::has('flash_message'))
	<div class="alert alert-success">
		{{ Session::get('flash_message') }}
	</div>
@endif

@if (count($errors) > 0)
	<div class="alert alert-danger">
		<strong>Whoops!</strong> There were some problems with your input.<br><br>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
<style>
    html, body {
      height: 100%;
    }
    #actions {
      margin: 2em 0;
    }


    /* Mimic table appearance */
    div.table {
      display: table;
    }
    div.table .file-row {
      display: table-row;
    }
    div.table .file-row > div {
      display: table-cell;
      vertical-align: top;
      border-top: 1px solid #ddd;
      padding: 8px;
    }
    div.table .file-row:nth-child(odd) {
      background: #f9f9f9;
    }



    /* The total progress gets shown by event listeners */
    #total-progress {
      opacity: 0;
      transition: opacity 0.3s linear;
    }

    /* Hide the progress bar when finished */
    #previews .file-row.dz-success .progress {
      opacity: 0;
      transition: opacity 0.3s linear;
    }

    /* Hide the delete button initially */
    #previews .file-row .delete {
      display: none;
    }

    /* Hide the start and cancel buttons and show the delete button */

    #previews .file-row.dz-success .start,
    #previews .file-row.dz-success .cancel {
      display: none;
    }
    #previews .file-row.dz-success .delete {
      display: block;
    }


  </style>

<h1>Upload Files</h1>
<div class="panel panel-primary" id = "files">
	<div class="panel-heading">
		<h3 class="panel-title">Upload Files</h3>
	</div>
	<div class="panel-body">	
	
{!! Form::open(['route'=>'uploadFiles', 'files'=>'true', 'id'=>'mydropzone', 'data-ajax'=>'true', 'class'=>'dropzone']) !!}

@include('files.partials.form')
	
{!! Form::close() !!}

	</div>
</div>	
<!--<a href="{{ URL::previous() }}" class="btn btn-primary" id = "previous">Prev</a >-->

@stop

@section('footer')

<script>

// Get the template HTML and remove it from the document
var previewNode = document.querySelector("#template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

var myDropzone = null;
Dropzone.options.mydropzone = {
  init: function() {
    myDropzone = this;
    
    // Update the total progress bar
    this.on("totaluploadprogress", function(progress) {
      document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
    });
    
    this.on("sending", function(file) {
      // Show the total progress bar when upload starts
      document.querySelector("#total-progress").style.opacity = "1";
      
    });
    
    // Hide the total progress bar when nothing's uploading anymore
    this.on("queuecomplete", function(progress) {
      document.querySelector("#total-progress").style.opacity = "0";
    });   
   
  },	
	maxFilesize: 2,
  previewsContainer: "#previews",
  clickable: ".fileinput-button",
  previewTemplate: previewTemplate,
  dictDefaultMessage: "",
  parallelUploads: 2,
  maxFiles: 6
};


// Setup the buttons for all transfers
// The "add files" button doesn't need to be setup because the config
// `clickable` has already been specified.
document.querySelector("#actions .cancel").onclick = function() {
  myDropzone.removeAllFiles(true);
};
</script>
	

@stop