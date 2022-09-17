@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card border--primary">
                <h5 class="card-header bg--primary d-flex flex-wrap justify-content-between align-items-center"><span class="d-block mr-2 text-white">{{__($survey->name)}}</span>  <a href="{{ route('admin.survey.report.download', $survey->id) }}" target="_blank" class="btn btn-sm btn-outline-light float-right"><i class="las la-download"></i>@lang('Download')
                </a>
                </h5>
                <div class="card-body">
                    @if(count($survey->questions) > 0)
                        @foreach ($survey->questions as $item)
               
                            @if($item->custom_input == 1)
                                @php
                                    $answer = App\Models\Answer::where('question_id',$item->id)->get(['custom_answer']);
                                @endphp
                            @endif 
 
                            <h5 class="card-header mt-3 border--primary d-flex flex-wrap justify-content-between align-items-center">
                                <span class="d-block mr-2">
                                    {{$loop->index+1}}. {{__($item->question)}} 
                                    @if($item->custom_input == 1) 
                                </span>
                                    <a href="#0" class="btn btn-sm btn--primary custom-answer" data-toggle="modal" data-target="#custom-answer" data-resource="{{$answer}}" data-question='{{ __($item->custom_question) }}'>
                                        @lang('Custom Answers')
                                    </a> 
                                    @endif
                            </h5>

                            <div class="row mt-30 mb-none-30">
                                @if($item->options)
                                    @foreach ($item->options as $data)
                                        @php
                                            $answer = App\Models\Answer::where('question_id', $item->id)->whereJsonContains('answer',$data)->count();
                                            $percent = getAmount((($answer / $item->answers->count()) * 100),2);
                                        @endphp

                                        <div class="col-xl-4 col-md-6 mb-30">
                                            <div class="widget-four b-radius--10 bg--white p-4 box--shadow2 hover--effect1">
                                                <div class="widget__icon bg--primary">
                                                    <h5 class="text-white">{{$loop->index+1}}</h5>
                                                </div>
                                                <div class="widget__content">
                                                    <p class="mb-2 font-weight-bold">{{__($data)}}</p>
                                                    <h4>{{$percent}}% </h4>
                                                    <div class="progressbar" data-perc="{{$percent}}%">
                                                        <div class="bar bg--danger"></div>
                                                    </div>
                                                    <span class="text--small">@lang('Total Response') {{$answer}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-xl-12 col-md-12 mb-30">
                                        <div class="widget-four b-radius--10 bg--white p-4 box--shadow2">
                                            <div class="widget__content">
                                                <p class="mb-2 font-weight-bold">@lang('No options available')</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @elseif(count($survey->questions) <= 0)
                        <h5 class="card-header mt-3 text-center">@lang('No question avaialable')</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="custom-answer" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title title"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div >
                <ul id="answer"></ul>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn--danger" data-dismiss="modal">@lang('Close')</button>
            </div>
          </div>
        </div>
      </div>
@endsection


@push('style')
    <style>
        .progressbar {
            position: relative;
            display: block;
            width: 100%;
            height: 5px;
            background-color: #e9ecef;
        }
        .bar {
            position:absolute;
            width: 0px;
            height: 100%;
            top: 0;
            left: 0;
            overflow:hidden;
        }
    </style>

@endpush

@push('script')
    <script>
        'use strict';

        $(".progressbar").each(function(){
        $(this).find(".bar").animate({
            "width": $(this).attr("data-perc")
        },2000);
        $(this).find(".label").animate({
            "left": $(this).attr("data-perc")
        },2000);
        });


        $('.custom-answer').on('click', function () {
            var modal = $('#custom-answer');
            modal.find('#answer').empty();
            modal.find('.title').text($(this).data('question')); 
            var resource = $(this).data('resource');

            $.each(resource, function (index, value) {
                if(value.custom_answer){
                    modal.find('#answer').append(`
                        <li><i class="las la-dot-circle"></i> ${value.custom_answer}</li>
                    `);
                }
            });
        });
    </script>
@endpush
