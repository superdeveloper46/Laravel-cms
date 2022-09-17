@extends('admin.layouts.app')

@section('panel')
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.survey.add.question') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg--2 mb-4">
                                        <p class="text-white"> <i class="fa fa-info-circle" aria-hidden="true"></i> <span class="font-weight-bold text-white">@lang('Note: ')</span>@lang(' If you want an answer that may not be in your option list then select') <span class="font-weight-bold text-white">@lang('Yes')</span> @lang('in') <span class="font-weight-bold text-white">@lang('Custom Input')</span> @lang('field and set related text for it.')</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="hidden" value="{{$survey->id}}" name="id" required>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>@lang('Question')</label>
                                            <input class="form-control" name="question" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 for-custom-input">
                                        <div class="form-group">
                                            <label>@lang('Select Answer Type')</label>
                                            <select name="type" class="form-control" required>
                                                <option value="1">@lang('Radio - (For single option)')</option>
                                                <option value="2">@lang('Checkbox - (For multiple option)')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 for-custom-input">
                                        <div class="form-group">
                                            <label>@lang('Custom Input (Additional Question)')?</label>
                                            <select name="custom_input" class="form-control" required>
                                                <option value="0">@lang('No')</option>
                                                <option value="1">@lang('Yes')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="custom-input-type">

                                    </div>
                                </div>

                                <div id="custom-input-question"></div>

                                <div class="payment-method-item">
                                    <div class="payment-method-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card border--primary">
                                                    <h5 class="card-header bg--primary  text-white">@lang('Add Options')
                                                        <button type="button" class="btn btn-sm btn-outline-light float-right addUserData"><i class="la la-fw la-plus"></i>@lang('Add New')
                                                        </button>
                                                    </h5>

                                                    <div class="card-body addedField">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="input-group mb-md-0">
                                                                        <input name="options[]" class="form-control" type="text" placeholder="@lang('Enter option')" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn--primary btn-block">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.survey.all') }}" class="btn btn-sm btn--dark box--shadow1 text--small"><i class="la la-fw la-backward"></i>@lang('Go Back')</a>
@endpush

@push('script')
<script>
    'use strict';

    (function ($) {
        var check_custom_input = $('select[name="custom_input"]').val();
        var custom_input_div = `<div class="form-group">
                                    <label>@lang('Additional Question')</label>
                                    <input type="text" name="custom_question" class="form-control" placeholder="@lang('Enter your custom input question')" required>
                                </div>`;

        var custom_input_type_div = `<div class="form-group">
                                        <label>@lang('Custom Input Type (Additional Question Type)')</label>
                                        <select name="custom_input_type" class="form-control" required>
                                            <option value="0">@lang('Not Required')</option>
                                            <option value="1">@lang('Required')</option>
                                        </select>
                                    </div>`;

        if (check_custom_input == 1) {

            $('#custom-input-question').html(custom_input_div);
            $('#custom-input-type').html(custom_input_type_div);
        }
        if (check_custom_input == 0) {
            $('.for-custom-input').removeClass('col-md-4').addClass('col-md-6');
            $('#custom-input-question').html('');
            $('#custom-input-type').html('');
        }

        $('select[name="custom_input"]').on('change',function () {

            if ($('select[name="custom_input"]').val() == 1) {

                $('#custom-input-question').html(custom_input_div);
                $('#custom-input-type').html(custom_input_type_div);
                $('.for-custom-input').removeClass('col-md-6').addClass('col-md-4');
            }
            if ($('select[name="custom_input"]').val() == 0) {

                $('#custom-input-question').html('');
                $('#custom-input-type').html('');
                $('.for-custom-input').removeClass('col-md-4').addClass('col-md-6');
            }
        });

        $('.addUserData').on('click', function () {
                var html = `
                <div class="row user-data">
                    <div class="col-md-11">
                        <div class="form-group">
                            <div class="input-group mb-md-0">
                                <input name="options[]" class="form-control" type="text" placeholder="@lang('Enter option')" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                                <button class="btn btn--danger btn-lg removeBtn w-100 mt-28 text-center" type="button">
                                    <i class="fa fa-times"></i>
                                </button>
                        <div class="form-group">
                    </div>
                </div>`;
                $('.addedField').append(html)
            });
            $(document).on('click', '.removeBtn', function () {
                $(this).closest('.user-data').remove();
            });

        })(jQuery);
</script>
@endpush
