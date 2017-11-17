@extends('adminlte::page')
@if($option != "")
@section('content_header')
{!! HighCharts::styles() !!}
@stop
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<!-- optional -->
<script src="http://code.highcharts.com/modules/offline-exporting.js"></script>
@endif
@section('content')


<form id="submit_pdf" action="/statesRequirements/download_pdf" method="post" target="_blank">
   <div class="col-md-3">
      <label class=" control-label">Seleccione reporte</label>
      {!! Form::select('options',
      $options, $option, [
      'id'=>'select_option',
      'class' => 'form-control col-sm-3 pull-right chosen'
      ]) !!}
   </div>
   <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
@if($option != "")
<div class="row">
   <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
      <div class="hpanel">
         <div class="tab-content">
            <div id="tab-1" class="tab-pane active">
               <div class="panel-body">
                  {!! $highchart->html() !!}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
{!! HighCharts::scripts() !!}
{!! $highchart->script() !!}
@endif
@endsection
@section('adminlte_js')
<script type="text/javascript">
   $('select#select_option').change(function () {
   var str = "";
   $("select#select_option option:selected").each(function () {
       str += $(this).val() + "";
   });
   
   var option = '{{$option}}';
   
   if(option != ""){
     var url = window.location.href.replace("GeneralReports/"+option, "GeneralReports/"+str);  
   }else{
       var url = window.location.href.replace("GeneralReports", "GeneralReports/"+str);
   }
   window.location.href = url;
   
   })
</script>
@stop