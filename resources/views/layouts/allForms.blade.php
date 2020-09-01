@extends('master')
@section('mainContent')
    <div class="page-header">
        <h1>
            Form Elements
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Common form elements and layouts
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Text Field </label>

                    <div class="col-sm-9">
                        <input autocomplete="off" type="text" id="form-field-1" placeholder="Username" class="col-xs-10 col-sm-5" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Full Length </label>

                    <div class="col-sm-9">
                        <input autocomplete="off" type="text" id="form-field-1-1" placeholder="Text Field" class="form-control" />
                    </div>
                </div>

                <div class="space-4"></div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Password Field </label>

                    <div class="col-sm-9">
                        <input autocomplete="off" type="password" id="form-field-2" placeholder="Password" class="col-xs-10 col-sm-5" />
                        <span class="help-inline col-xs-12 col-sm-7">
												<span class="middle">Inline help text</span>
											</span>
                    </div>
                </div>

                <div class="space-4"></div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-input-readonly"> Readonly field </label>

                    <div class="col-sm-9">
                        <input readonly="" type="text" class="col-xs-10 col-sm-5" id="form-input-readonly" value="This text field is readonly!" />
                        <span class="help-inline col-xs-12 col-sm-7">
												<label class="middle">
													<input class="ace" type="checkbox" id="id-disable-check" />
													<span class="lbl"> Disable it!</span>
												</label>
											</span>
                    </div>
                </div>

                <div class="space-4"></div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-4">Relative Sizing</label>

                    <div class="col-sm-9">
                        <input class="input-sm" type="text" id="form-field-4" placeholder=".input-sm" />
                        <div class="space-2"></div>

                        <div class="help-block" id="input-size-slider"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-5">Grid Sizing</label>

                    <div class="col-sm-9">
                        <div class="clearfix">
                            <input class="col-xs-1" type="text" id="form-field-5" placeholder=".col-xs-1" />
                        </div>

                        <div class="space-2"></div>

                        <div class="help-block" id="input-span-slider"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right">Input with Icon</label>

                    <div class="col-sm-9">
											<span class="input-icon">
												<input autocomplete="off" type="text" id="form-field-icon-1" />
												<i class="ace-icon fa fa-leaf blue"></i>
											</span>

                        <span class="input-icon input-icon-right">
												<input autocomplete="off" type="text" id="form-field-icon-2" />
												<i class="ace-icon fa fa-leaf green"></i>
											</span>
                    </div>
                </div>

                <div class="space-4"></div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-6">Tooltip and help button</label>

                    <div class="col-sm-9">
                        <input data-rel="tooltip" type="text" id="form-field-6" placeholder="Tooltip on hover" title="Hello Tooltip!" data-placement="bottom" />
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="More details." title="Popover on hover">?</span>
                    </div>
                </div>

                <div class="space-4"></div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-tags">Tag input</label>

                    <div class="col-sm-9">
                        <div class="inline">
                            <input autocomplete="off" type="text" name="tags" id="form-field-tags" value="Tag Input Control" placeholder="Enter tags ..." />
                        </div>
                    </div>
                </div>

                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" type="button">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Submit
                        </button>

                        &nbsp; &nbsp; &nbsp;
                        <button class="btn" type="reset">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            Reset
                        </button>
                    </div>
                </div>

                <div class="hr hr-24"></div>

                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4 class="widget-title">Text Area</h4>

                                <div class="widget-toolbar">
                                    <a href="#" data-action="collapse">
                                        <i class="ace-icon fa fa-chevron-up"></i>
                                    </a>

                                    <a href="#" data-action="close">
                                        <i class="ace-icon fa fa-times"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div>
                                        <label for="form-field-8">Default</label>

                                        <textarea class="form-control" id="form-field-8" placeholder="Default Text"></textarea>
                                    </div>

                                    <hr />

                                    <div>
                                        <label for="form-field-9">With Character Limit</label>

                                        <textarea class="form-control limited" id="form-field-9" maxlength="50"></textarea>
                                    </div>

                                    <hr />

                                    <div>
                                        <label for="form-field-11">Autosize</label>

                                        <textarea id="form-field-11" class="autosize-transition form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.span -->

                    <div class="col-xs-12 col-sm-4">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4 class="widget-title">Masked Input</h4>

                                <span class="widget-toolbar">
														<a href="#" data-action="settings">
															<i class="ace-icon fa fa-cog"></i>
														</a>

														<a href="#" data-action="reload">
															<i class="ace-icon fa fa-refresh"></i>
														</a>

														<a href="#" data-action="collapse">
															<i class="ace-icon fa fa-chevron-up"></i>
														</a>

														<a href="#" data-action="close">
															<i class="ace-icon fa fa-times"></i>
														</a>
													</span>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div>
                                        <label for="form-field-mask-1">
                                            Date
                                            <small class="text-success">99/99/9999</small>
                                        </label>

                                        <div class="input-group">
                                            <input class="form-control input-mask-date" type="text" id="form-field-mask-1" />
                                            <span class="input-group-btn">
																	<button class="btn btn-sm btn-default" type="button">
																		<i class="ace-icon fa fa-calendar bigger-110"></i>
																		Go!
																	</button>
																</span>
                                        </div>
                                    </div>

                                    <hr />
                                    <div>
                                        <label for="form-field-mask-2">
                                            Phone
                                            <small class="text-warning">(999) 999-9999</small>
                                        </label>

                                        <div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-phone"></i>
																</span>

                                            <input class="form-control input-mask-phone" type="text" id="form-field-mask-2" />
                                        </div>
                                    </div>

                                    <hr />
                                    <div>
                                        <label for="form-field-mask-3">
                                            Product Key
                                            <small class="text-error">a*-999-a999</small>
                                        </label>

                                        <div class="input-group">
                                            <input class="form-control input-mask-product" type="text" id="form-field-mask-3" />
                                            <span class="input-group-addon">
																	<i class="ace-icon fa fa-key"></i>
																</span>
                                        </div>
                                    </div>

                                    <hr />
                                    <div>
                                        <label for="form-field-mask-4">
                                            Eye Script
                                            <small class="text-info">~9.99 ~9.99 999</small>
                                        </label>

                                        <div>
                                            <input class="input-medium input-mask-eyescript" type="text" id="form-field-mask-4" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.span -->

                    <div class="col-xs-12 col-sm-4">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4 class="widget-title">Select Box</h4>

                                <span class="widget-toolbar">
														<a href="#" data-action="settings">
															<i class="ace-icon fa fa-cog"></i>
														</a>

														<a href="#" data-action="reload">
															<i class="ace-icon fa fa-refresh"></i>
														</a>

														<a href="#" data-action="collapse">
															<i class="ace-icon fa fa-chevron-up"></i>
														</a>

														<a href="#" data-action="close">
															<i class="ace-icon fa fa-times"></i>
														</a>
													</span>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div>
                                        <label for="form-field-select-1">Default</label>

                                        <select class="form-control" id="form-field-select-1">
                                            <option value=""></option>
                                            <option value="AL">Alabama</option>
                                            <option value="AK">Alaska</option>
                                            <option value="AZ">Arizona</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="CA">California</option>
                                            <option value="CO">Colorado</option>
                                            <option value="CT">Connecticut</option>
                                            <option value="DE">Delaware</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="HI">Hawaii</option>
                                            <option value="ID">Idaho</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IN">Indiana</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="ME">Maine</option>
                                            <option value="MD">Maryland</option>
                                            <option value="MA">Massachusetts</option>
                                            <option value="MI">Michigan</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MO">Missouri</option>
                                            <option value="MT">Montana</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NV">Nevada</option>
                                            <option value="NH">New Hampshire</option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="NY">New York</option>
                                            <option value="NC">North Carolina</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="OH">Ohio</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="OR">Oregon</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SC">South Carolina</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="TX">Texas</option>
                                            <option value="UT">Utah</option>
                                            <option value="VT">Vermont</option>
                                            <option value="VA">Virginia</option>
                                            <option value="WA">Washington</option>
                                            <option value="WV">West Virginia</option>
                                            <option value="WI">Wisconsin</option>
                                            <option value="WY">Wyoming</option>
                                        </select>
                                    </div>

                                    <hr />
                                    <div>
                                        <label for="form-field-select-2">Multiple</label>

                                        <select class="form-control" id="form-field-select-2" multiple="multiple">
                                            <option value="AL">Alabama</option>
                                            <option value="AK">Alaska</option>
                                            <option value="AZ">Arizona</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="CA">California</option>
                                            <option value="CO">Colorado</option>
                                            <option value="CT">Connecticut</option>
                                            <option value="DE">Delaware</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="HI">Hawaii</option>
                                            <option value="ID">Idaho</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IN">Indiana</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="ME">Maine</option>
                                            <option value="MD">Maryland</option>
                                            <option value="MA">Massachusetts</option>
                                            <option value="MI">Michigan</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MO">Missouri</option>
                                            <option value="MT">Montana</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NV">Nevada</option>
                                            <option value="NH">New Hampshire</option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="NY">New York</option>
                                            <option value="NC">North Carolina</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="OH">Ohio</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="OR">Oregon</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SC">South Carolina</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="TX">Texas</option>
                                            <option value="UT">Utah</option>
                                            <option value="VT">Vermont</option>
                                            <option value="VA">Virginia</option>
                                            <option value="WA">Washington</option>
                                            <option value="WV">West Virginia</option>
                                            <option value="WI">Wisconsin</option>
                                            <option value="WY">Wyoming</option>
                                        </select>
                                    </div>

                                    <hr />

                                    <div>
                                        <label for="form-field-select-3">Chosen</label>

                                        <br />
                                        <select class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose a State...">
                                            <option value="">  </option>
                                            <option value="AL">Alabama</option>
                                            <option value="AK">Alaska</option>
                                            <option value="AZ">Arizona</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="CA">California</option>
                                            <option value="CO">Colorado</option>
                                            <option value="CT">Connecticut</option>
                                            <option value="DE">Delaware</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="HI">Hawaii</option>
                                            <option value="ID">Idaho</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IN">Indiana</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="ME">Maine</option>
                                            <option value="MD">Maryland</option>
                                            <option value="MA">Massachusetts</option>
                                            <option value="MI">Michigan</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MO">Missouri</option>
                                            <option value="MT">Montana</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NV">Nevada</option>
                                            <option value="NH">New Hampshire</option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="NY">New York</option>
                                            <option value="NC">North Carolina</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="OH">Ohio</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="OR">Oregon</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SC">South Carolina</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="TX">Texas</option>
                                            <option value="UT">Utah</option>
                                            <option value="VT">Vermont</option>
                                            <option value="VA">Virginia</option>
                                            <option value="WA">Washington</option>
                                            <option value="WV">West Virginia</option>
                                            <option value="WI">Wisconsin</option>
                                            <option value="WY">Wyoming</option>
                                        </select>
                                    </div>

                                    <hr />
                                    <div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <span class="bigger-110">Multiple</span>
                                            </div><!-- /.span -->

                                            <div class="col-sm-6">
																	<span class="pull-right inline">
																		<span class="grey">style:</span>

																		<span class="btn-toolbar inline middle no-margin">
																			<span id="chosen-multiple-style" data-toggle="buttons" class="btn-group no-margin">
																				<label class="btn btn-xs btn-yellow active">
																					1
																					<input type="radio" value="1" />
																				</label>

																				<label class="btn btn-xs btn-yellow">
																					2
																					<input type="radio" value="2" />
																				</label>
																			</span>
																		</span>
																	</span>
                                            </div><!-- /.span -->
                                        </div>

                                        <div class="space-2"></div>

                                        <select multiple="" class="chosen-select form-control" id="form-field-select-4" data-placeholder="Choose a State...">
                                            <option value="AL">Alabama</option>
                                            <option value="AK">Alaska</option>
                                            <option value="AZ">Arizona</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="CA">California</option>
                                            <option value="CO">Colorado</option>
                                            <option value="CT">Connecticut</option>
                                            <option value="DE">Delaware</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="HI">Hawaii</option>
                                            <option value="ID">Idaho</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IN">Indiana</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="ME">Maine</option>
                                            <option value="MD">Maryland</option>
                                            <option value="MA">Massachusetts</option>
                                            <option value="MI">Michigan</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MO">Missouri</option>
                                            <option value="MT">Montana</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NV">Nevada</option>
                                            <option value="NH">New Hampshire</option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="NY">New York</option>
                                            <option value="NC">North Carolina</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="OH">Ohio</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="OR">Oregon</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SC">South Carolina</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="TX">Texas</option>
                                            <option value="UT">Utah</option>
                                            <option value="VT">Vermont</option>
                                            <option value="VA">Virginia</option>
                                            <option value="WA">Washington</option>
                                            <option value="WV">West Virginia</option>
                                            <option value="WI">Wisconsin</option>
                                            <option value="WY">Wyoming</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.span -->
                </div><!-- /.row -->

                <div class="space-24"></div>

                <h3 class="header smaller lighter blue">
                    Checkboxes & Radio
                    <small>All Checkboxes, Radios and Switch Buttons Are Pure CSS</small>
                </h3>

                <div class="row">
                    <div class="col-xs-12 col-sm-5">
                        <div class="control-group">
                            <label class="control-label bolder blue">Checkbox</label>

                            <div class="checkbox">
                                <label>
                                    <input autocomplete="off" name="form-field-checkbox" type="checkbox" class="ace" />
                                    <span class="lbl"> choice 1</span>
                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input autocomplete="off" name="form-field-checkbox" type="checkbox" class="ace" />
                                    <span class="lbl"> choice 2</span>
                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input autocomplete="off" name="form-field-checkbox" class="ace ace-checkbox-2" type="checkbox" />
                                    <span class="lbl"> choice 3</span>
                                </label>
                            </div>

                            <div class="checkbox">
                                <label class="block">
                                    <input autocomplete="off" name="form-field-checkbox" disabled="" type="checkbox" class="ace" />
                                    <span class="lbl"> disabled</span>
                                </label>
                            </div>

                            <div class="checkbox">
                                <label class="block">
                                    <input autocomplete="off" name="form-field-checkbox" type="checkbox" class="ace input-lg" />
                                    <span class="lbl bigger-120"> large checkbox</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6">
                        <div class="control-group">
                            <label class="control-label bolder blue">Radio</label>

                            <div class="radio">
                                <label>
                                    <input autocomplete="off" name="form-field-radio" type="radio" class="ace" />
                                    <span class="lbl"> radio option 1</span>
                                </label>
                            </div>

                            <div class="radio">
                                <label>
                                    <input autocomplete="off" name="form-field-radio" type="radio" class="ace" />
                                    <span class="lbl"> radio option 2</span>
                                </label>
                            </div>

                            <div class="radio">
                                <label>
                                    <input autocomplete="off" name="form-field-radio" type="radio" class="ace" />
                                    <span class="lbl"> radio option 3</span>
                                </label>
                            </div>

                            <div class="radio">
                                <label>
                                    <input disabled="" name="form-field-radio" type="radio" class="ace" />
                                    <span class="lbl"> disabled</span>
                                </label>
                            </div>

                            <div class="radio">
                                <label>
                                    <input autocomplete="off" name="form-field-radio" type="radio" class="ace input-lg" />
                                    <span class="lbl bigger-120"> large radio</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div><!-- /.row -->

                <hr />
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3">On/Off Switches</label>

                    <div class="controls col-xs-12 col-sm-9">
                        <div class="row">
                            <div class="col-xs-3">
                                <label>
                                    <input autocomplete="off" name="switch-field-1" class="ace ace-switch" type="checkbox" />
                                    <span class="lbl"></span>
                                </label>
                            </div>

                            <div class="col-xs-3">
                                <label>
                                    <input autocomplete="off" name="switch-field-1" class="ace ace-switch ace-switch-2" type="checkbox" />
                                    <span class="lbl"></span>
                                </label>
                            </div>

                            <div class="col-xs-3">
                                <label>
                                    <input autocomplete="off" name="switch-field-1" class="ace ace-switch ace-switch-3" type="checkbox" />
                                    <span class="lbl"></span>
                                </label>
                            </div>

                            <div class="col-xs-3">
                                <label>
                                    <input autocomplete="off" name="switch-field-1" class="ace ace-switch" type="checkbox" />
                                    <span class="lbl" data-lbl="CUS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOM"></span>
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-3">
                                <label>
                                    <input autocomplete="off" name="switch-field-1" class="ace ace-switch ace-switch-4" type="checkbox" />
                                    <span class="lbl"></span>
                                </label>
                            </div>

                            <div class="col-xs-3">
                                <label>
                                    <input autocomplete="off" name="switch-field-1" class="ace ace-switch ace-switch-5" type="checkbox" />
                                    <span class="lbl"></span>
                                </label>
                            </div>

                            <div class="col-xs-3">
                                <label>
                                    <input autocomplete="off" name="switch-field-1" class="ace ace-switch ace-switch-6" type="checkbox" />
                                    <span class="lbl"></span>
                                </label>
                            </div>

                            <div class="col-xs-3">
                                <label>
                                    <input autocomplete="off" name="switch-field-1" class="ace ace-switch ace-switch-7" type="checkbox" />
                                    <span class="lbl"></span>
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-3">
                                <label>
                                    <input autocomplete="off" name="switch-field-1" class="ace ace-switch btn-rotate" type="checkbox" />
                                    <span class="lbl"></span>
                                </label>
                            </div>

                            <div class="col-xs-3">
                                <label>
                                    <input autocomplete="off" name="switch-field-1" class="ace ace-switch ace-switch-4 btn-rotate" type="checkbox" />
                                    <span class="lbl"></span>
                                </label>
                            </div>

                            <div class="col-xs-3">
                                <label>
                                    <input autocomplete="off" name="switch-field-1" class="ace ace-switch ace-switch-4 btn-empty" type="checkbox" />
                                    <span class="lbl"></span>
                                </label>
                            </div>

                            <div class="col-xs-3">
                                <label>
                                    <input autocomplete="off" name="switch-field-1" class="ace ace-switch ace-switch-4 btn-flat" type="checkbox" />
                                    <span class="lbl"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <hr />
                <div class="row">
                    <div class="col-sm-4">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4 class="widget-title">Custom File Input</h4>

                                <div class="widget-toolbar">
                                    <a href="#" data-action="collapse">
                                        <i class="ace-icon fa fa-chevron-up"></i>
                                    </a>

                                    <a href="#" data-action="close">
                                        <i class="ace-icon fa fa-times"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input type="file" id="id-input-file-2" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input multiple="" type="file" id="id-input-file-3" />
                                        </div>
                                    </div>

                                    <label>
                                        <input type="checkbox" name="file-format" id="id-file-format" class="ace" />
                                        <span class="lbl"> Allow only images</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4 class="widget-title">jQuery UI Sliders</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row">
                                        <div class="col-xs-3 col-md-2">
                                            <div id="slider-range"></div>
                                        </div>

                                        <div class="col-xs-9 col-md-10">
                                            <div id="slider-eq">
                                                <span class="ui-slider-green ui-slider-small">77</span>
                                                <span class="ui-slider-red">55</span>
                                                <span class="ui-slider-purple" data-rel="tooltip" title="Disabled!">33</span>
                                                <span class="ui-slider-simple ui-slider-orange">40</span>
                                                <span class="ui-slider-simple ui-slider-dark">88</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4 class="widget-title">Spinners</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <input autocomplete="off" type="text" id="spinner1" />
                                    <div class="space-6"></div>

                                    <input autocomplete="off" type="text" class="input-sm" id="spinner2" />
                                    <div class="space-6"></div>

                                    <input autocomplete="off" type="text" id="spinner3" />
                                    <div class="space-6"></div>

                                    <input autocomplete="off" type="text" class="input-lg" id="spinner4" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr />
                <div class="row">
                    <div class="col-sm-4">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4 class="widget-title">Date Picker</h4>

                                <span class="widget-toolbar">
														<a href="#" data-action="settings">
															<i class="ace-icon fa fa-cog"></i>
														</a>

														<a href="#" data-action="reload">
															<i class="ace-icon fa fa-refresh"></i>
														</a>

														<a href="#" data-action="collapse">
															<i class="ace-icon fa fa-chevron-up"></i>
														</a>

														<a href="#" data-action="close">
															<i class="ace-icon fa fa-times"></i>
														</a>
													</span>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <label for="id-date-picker-1">Date Picker</label>

                                    <div class="row">
                                        <div class="col-xs-8 col-sm-11">
                                            <div class="input-group">
                                                <input class="form-control date-picker" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" />
                                                <span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space space-8"></div>
                                    <label>Range Picker</label>

                                    <div class="row">
                                        <div class="col-xs-8 col-sm-11">
                                            <div class="input-daterange input-group">
                                                <input autocomplete="off" type="text" class="input-sm form-control" name="start" />
                                                <span class="input-group-addon">
																		<i class="fa fa-exchange"></i>
																	</span>

                                                <input autocomplete="off" type="text" class="input-sm form-control" name="end" />
                                            </div>
                                        </div>
                                    </div>

                                    <hr />
                                    <label for="id-date-range-picker-1">Date Range Picker</label>

                                    <div class="row">
                                        <div class="col-xs-8 col-sm-11">
                                            <div class="input-group">
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>

                                                <input class="form-control" type="text" name="date-range-picker" id="id-date-range-picker-1" />
                                            </div>
                                        </div>
                                    </div>

                                    <hr />
                                    <label for="timepicker1">Time Picker</label>

                                    <div class="input-group bootstrap-timepicker">
                                        <input autocomplete="off" id="timepicker1" type="text" class="form-control" />
                                        <span class="input-group-addon">
																<i class="fa fa-clock-o bigger-110"></i>
															</span>
                                    </div>

                                    <hr />
                                    <label for="date-timepicker1">Date/Time Picker</label>

                                    <div class="input-group">
                                        <input autocomplete="off" id="date-timepicker1" type="text" class="form-control" />
                                        <span class="input-group-addon">
																<i class="fa fa-clock-o bigger-110"></i>
															</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4 class="widget-title">
                                    <i class="ace-icon fa fa-tint"></i>
                                    Color Picker
                                </h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="clearfix">
                                        <label for="colorpicker1">Color Picker</label>
                                    </div>

                                    <div class="control-group">
                                        <div class="bootstrap-colorpicker">
                                            <input autocomplete="off" id="colorpicker1" type="text" class="input-small" />
                                        </div>
                                    </div>

                                    <hr />

                                    <div>
                                        <label for="simple-colorpicker-1">Custom Color Picker</label>

                                        <select id="simple-colorpicker-1" class="hide">
                                            <option value="#ac725e">#ac725e</option>
                                            <option value="#d06b64">#d06b64</option>
                                            <option value="#f83a22">#f83a22</option>
                                            <option value="#fa573c">#fa573c</option>
                                            <option value="#ff7537">#ff7537</option>
                                            <option value="#ffad46" selected="">#ffad46</option>
                                            <option value="#42d692">#42d692</option>
                                            <option value="#16a765">#16a765</option>
                                            <option value="#7bd148">#7bd148</option>
                                            <option value="#b3dc6c">#b3dc6c</option>
                                            <option value="#fbe983">#fbe983</option>
                                            <option value="#fad165">#fad165</option>
                                            <option value="#92e1c0">#92e1c0</option>
                                            <option value="#9fe1e7">#9fe1e7</option>
                                            <option value="#9fc6e7">#9fc6e7</option>
                                            <option value="#4986e7">#4986e7</option>
                                            <option value="#9a9cff">#9a9cff</option>
                                            <option value="#b99aff">#b99aff</option>
                                            <option value="#c2c2c2">#c2c2c2</option>
                                            <option value="#cabdbf">#cabdbf</option>
                                            <option value="#cca6ac">#cca6ac</option>
                                            <option value="#f691b2">#f691b2</option>
                                            <option value="#cd74e6">#cd74e6</option>
                                            <option value="#a47ae2">#a47ae2</option>
                                            <option value="#555">#555</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4 class="widget-title">
                                    <i class="ace-icon fa fa-tachometer"></i>
                                    Knob Input
                                </h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="control-group">
                                        <div class="row">
                                            <div class="col-xs-6 center">
                                                <div class="knob-container inline">
                                                    <input autocomplete="off" type="text" class="input-small knob" value="15" data-min="0" data-max="100" data-step="10" data-width="80" data-height="80" data-thickness=".2" />
                                                </div>
                                            </div>

                                            <div class="col-xs-6  center">
                                                <div class="knob-container inline">
                                                    <input autocomplete="off" type="text" class="input-small knob" value="41" data-min="0" data-max="100" data-width="80" data-height="80" data-thickness=".2" data-fgcolor="#87B87F" data-displayprevious="true" data-anglearc="250" data-angleoffset="-125" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 center">
                                                <div class="knob-container inline">
                                                    <input autocomplete="off" type="text" class="input-small knob" value="1" data-min="0" data-max="10" data-width="150" data-height="150" data-thickness=".2" data-fgcolor="#B8877F" data-angleoffset="90" data-cursor="true" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="hr hr-18 dotted hr-double"></div>

            <h4 class="pink">
                <i class="ace-icon fa fa-hand-o-right green"></i>
                <a href="#modal-form" role="button" class="blue" data-toggle="modal"> Form Inside a Modal Box </a>
            </h4>

            <div class="hr hr-18 dotted hr-double"></div>
            <h4 class="header green">Form Layouts</h4>

            <div class="row">
                <div class="col-sm-5">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4 class="widget-title">Default</h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main no-padding">
                                <form>
                                    <!-- <legend>Form</legend> -->
                                    <fieldset>
                                        <label>Label name</label>

                                        <input autocomplete="off" type="text" placeholder="Type something&hellip;" />
                                        <span class="help-block">Example block-level help text here.</span>

                                        <label class="pull-right">
                                            <input type="checkbox" class="ace" />
                                            <span class="lbl"> check me out</span>
                                        </label>
                                    </fieldset>

                                    <div class="form-actions center">
                                        <button type="button" class="btn btn-sm btn-success">
                                            Submit
                                            <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-7">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4 class="widget-title">Inline Forms</h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <form class="form-inline">
                                    <input autocomplete="off" type="text" class="input-small" placeholder="Username" />
                                    <input autocomplete="off" type="password" class="input-small" placeholder="Password" />
                                    <label class="inline">
                                        <input type="checkbox" class="ace" />
                                        <span class="lbl"> remember me</span>
                                    </label>

                                    <button type="button" class="btn btn-info btn-sm">
                                        <i class="ace-icon fa fa-key bigger-110"></i>Login
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="space-6"></div>

                    <div class="widget-box">
                        <div class="widget-header widget-header-small">
                            <h5 class="widget-title lighter">Search Form</h5>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <form class="form-search">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-8">
                                            <div class="input-group">
																	<span class="input-group-addon">
																		<i class="ace-icon fa fa-check"></i>
																	</span>

                                                <input autocomplete="off" type="text" class="form-control search-query" placeholder="Type your query" />
                                                <span class="input-group-btn">
																		<button type="button" class="btn btn-purple btn-sm">
																			<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
																			Search
																		</button>
																	</span>
                                            </div>

                                            <div class="hr"></div>

                                            <div class="input-group input-group-lg">
																	<span class="input-group-addon">
																		<i class="ace-icon fa fa-check"></i>
																	</span>

                                                <input autocomplete="off" type="text" class="form-control search-query" placeholder="Type your query" />
                                                <span class="input-group-btn">
																		<button type="button" class="btn btn-default btn-lg">
																			<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
																			Search
																		</button>
																	</span>
                                            </div>

                                            <div class="hr"></div>

                                            <div class="input-group">
																	<span class="input-group-addon">
																		<i class="ace-icon fa fa-check"></i>
																	</span>

                                                <input autocomplete="off" type="text" class="form-control search-query" placeholder="Type your query" />
                                                <span class="input-group-btn">
																		<button type="button" class="btn btn-inverse btn-white">
																			<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
																			Search
																		</button>
																	</span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modal-form" class="modal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="blue bigger">Please fill the following form fields</h4>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-5">
                                    <div class="space"></div>

                                    <input type="file" />
                                </div>

                                <div class="col-xs-12 col-sm-7">
                                    <div class="form-group">
                                        <label for="form-field-select-3">Location</label>

                                        <div>
                                            <select class="chosen-select" data-placeholder="Choose a Country...">
                                                <option value="MI">Michigan</option>
                                                <option value="MN">Minnesota</option>
                                                <option value="MS">Mississippi</option>
                                                <option value="MO">Missouri</option>
                                                <option value="MT">Montana</option>
                                                <option value="NE">Nebraska</option>
                                                <option value="NV">Nevada</option>
                                                <option value="NH">New Hampshire</option>
                                                <option value="NJ">New Jersey</option>
                                                <option value="NM">New Mexico</option>
                                                <option value="NY">New York</option>
                                                <option value="NC">North Carolina</option>
                                                <option value="ND">North Dakota</option>
                                                <option value="OH">Ohio</option>
                                                <option value="OK">Oklahoma</option>
                                                <option value="OR">Oregon</option>
                                                <option value="PA">Pennsylvania</option>
                                                <option value="RI">Rhode Island</option>
                                                <option value="SC">South Carolina</option>
                                                <option value="SD">South Dakota</option>
                                                <option value="TN">Tennessee</option>
                                                <option value="TX">Texas</option>
                                                <option value="UT">Utah</option>
                                                <option value="VT">Vermont</option>
                                                <option value="VA">Virginia</option>
                                                <option value="WA">Washington</option>
                                                <option value="WV">West Virginia</option>
                                                <option value="WI">Wisconsin</option>
                                                <option value="WY">Wyoming</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="space-4"></div>

                                    <div class="form-group">
                                        <label for="form-field-username">Username</label>

                                        <div>
                                            <input autocomplete="off" type="text" id="form-field-username" placeholder="Username" value="alexdoe" />
                                        </div>
                                    </div>

                                    <div class="space-4"></div>

                                    <div class="form-group">
                                        <label for="form-field-first">Name</label>

                                        <div>
                                            <input autocomplete="off" type="text" id="form-field-first" placeholder="First Name" value="Alex" />
                                            <input autocomplete="off" type="text" id="form-field-last" placeholder="Last Name" value="Doe" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-sm" data-dismiss="modal">
                                <i class="ace-icon fa fa-times"></i>
                                Cancel
                            </button>

                            <button class="btn btn-sm btn-primary">
                                <i class="ace-icon fa fa-check"></i>
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div><!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div>

    {{--Wizerd Form--}}

    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <h4 class="lighter">
                <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer blue"></i>
                <a href="#modal-wizard" data-toggle="modal" class="pink"> Wizard Inside a Modal Box </a>
            </h4>

            <div class="hr hr-18 hr-double dotted"></div>

            <div class="widget-box">
                <div class="widget-header widget-header-blue widget-header-flat">
                    <h4 class="widget-title lighter">New Item Wizard</h4>

                    <div class="widget-toolbar">
                        <label>
                            <small class="green">
                                <b>Validation</b>
                            </small>

                            <input autocomplete="off" id="skip-validation" type="checkbox" class="ace ace-switch ace-switch-4" />
                            <span class="lbl middle"></span>
                        </label>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <div id="fuelux-wizard-container">
                            <div>
                                <ul class="steps">
                                    <li data-step="1" class="active">
                                        <span class="step">1</span>
                                        <span class="title">Validation states</span>
                                    </li>

                                    <li data-step="2">
                                        <span class="step">2</span>
                                        <span class="title">Alerts</span>
                                    </li>

                                    <li data-step="3">
                                        <span class="step">3</span>
                                        <span class="title">Payment Info</span>
                                    </li>

                                    <li data-step="4">
                                        <span class="step">4</span>
                                        <span class="title">Other Info</span>
                                    </li>
                                </ul>
                            </div>

                            <hr />

                            <div class="step-content pos-rel">
                                <div class="step-pane active" data-step="1">
                                    <h3 class="lighter block green">Enter the following information</h3>

                                    <form class="form-horizontal" id="sample-form">
                                        <div class="form-group has-warning">
                                            <label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Input with warning</label>

                                            <div class="col-xs-12 col-sm-5">
																	<span class="block input-icon input-icon-right">
																		<input autocomplete="off" type="text" id="inputWarning" class="width-100" />
																		<i class="ace-icon fa fa-leaf"></i>
																	</span>
                                            </div>
                                            <div class="help-block col-xs-12 col-sm-reset inline"> Warning tip help! </div>
                                        </div>

                                        <div class="form-group has-error">
                                            <label for="inputError" class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Input with error</label>

                                            <div class="col-xs-12 col-sm-5">
																	<span class="block input-icon input-icon-right">
																		<input autocomplete="off" type="text" id="inputError" class="width-100" />
																		<i class="ace-icon fa fa-times-circle"></i>
																	</span>
                                            </div>
                                            <div class="help-block col-xs-12 col-sm-reset inline"> Error tip help! </div>
                                        </div>

                                        <div class="form-group has-success">
                                            <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right">Input with success</label>

                                            <div class="col-xs-12 col-sm-5">
																	<span class="block input-icon input-icon-right">
																		<input autocomplete="off" type="text" id="inputSuccess" class="width-100" />
																		<i class="ace-icon fa fa-check-circle"></i>
																	</span>
                                            </div>
                                            <div class="help-block col-xs-12 col-sm-reset inline"> Success tip help! </div>
                                        </div>

                                        <div class="form-group has-info">
                                            <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Input with info</label>

                                            <div class="col-xs-12 col-sm-5">
																	<span class="block input-icon input-icon-right">
																		<input autocomplete="off" type="text" id="inputInfo" class="width-100" />
																		<i class="ace-icon fa fa-info-circle"></i>
																	</span>
                                            </div>
                                            <div class="help-block col-xs-12 col-sm-reset inline"> Info tip help! </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputError2" class="col-xs-12 col-sm-3 control-label no-padding-right">Input with error</label>

                                            <div class="col-xs-12 col-sm-5">
																	<span class="input-icon block">
																		<input autocomplete="off" type="text" id="inputError2" class="width-100" />
																		<i class="ace-icon fa fa-times-circle red"></i>
																	</span>
                                            </div>
                                            <div class="help-block col-xs-12 col-sm-reset inline"> Error tip help! </div>
                                        </div>
                                    </form>

                                    <form class="form-horizontal hide" id="validation-form" method="get">
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Email Address:</label>

                                            <div class="col-xs-12 col-sm-9">
                                                <div class="clearfix">
                                                    <input type="email" name="email" id="email" class="col-xs-12 col-sm-6" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-2"></div>

                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Password:</label>

                                            <div class="col-xs-12 col-sm-9">
                                                <div class="clearfix">
                                                    <input autocomplete="off" type="password" name="password" id="password" class="col-xs-12 col-sm-4" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-2"></div>

                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password2">Confirm Password:</label>

                                            <div class="col-xs-12 col-sm-9">
                                                <div class="clearfix">
                                                    <input autocomplete="off" type="password" name="password2" id="password2" class="col-xs-12 col-sm-4" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hr hr-dotted"></div>

                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">Company Name:</label>

                                            <div class="col-xs-12 col-sm-9">
                                                <div class="clearfix">
                                                    <input autocomplete="off" type="text" id="name" name="name" class="col-xs-12 col-sm-5" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-2"></div>

                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="phone">Phone Number:</label>

                                            <div class="col-xs-12 col-sm-9">
                                                <div class="input-group">
																		<span class="input-group-addon">
																			<i class="ace-icon fa fa-phone"></i>
																		</span>

                                                    <input type="tel" id="phone" name="phone" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-2"></div>

                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="url">Company URL:</label>

                                            <div class="col-xs-12 col-sm-9">
                                                <div class="clearfix">
                                                    <input type="url" id="url" name="url" class="col-xs-12 col-sm-8" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hr hr-dotted"></div>

                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right">Subscribe to</label>

                                            <div class="col-xs-12 col-sm-9">
                                                <div>
                                                    <label>
                                                        <input autocomplete="off" name="subscription" value="1" type="checkbox" class="ace" />
                                                        <span class="lbl"> Latest news and announcements</span>
                                                    </label>
                                                </div>

                                                <div>
                                                    <label>
                                                        <input autocomplete="off" name="subscription" value="2" type="checkbox" class="ace" />
                                                        <span class="lbl"> Product offers and discounts</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-2"></div>

                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right">Gender</label>

                                            <div class="col-xs-12 col-sm-9">
                                                <div>
                                                    <label class="line-height-1 blue">
                                                        <input autocomplete="off" name="gender" value="1" type="radio" class="ace" />
                                                        <span class="lbl"> Male</span>
                                                    </label>
                                                </div>

                                                <div>
                                                    <label class="line-height-1 blue">
                                                        <input autocomplete="off" name="gender" value="2" type="radio" class="ace" />
                                                        <span class="lbl"> Female</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hr hr-dotted"></div>

                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">State</label>

                                            <div class="col-xs-12 col-sm-9">
                                                <select id="state" name="state" class="select2" data-placeholder="Click to Choose...">
                                                    <option value="">&nbsp;</option>
                                                    <option value="AL">Alabama</option>
                                                    <option value="AK">Alaska</option>
                                                    <option value="AZ">Arizona</option>
                                                    <option value="AR">Arkansas</option>
                                                    <option value="CA">California</option>
                                                    <option value="CO">Colorado</option>
                                                    <option value="CT">Connecticut</option>
                                                    <option value="DE">Delaware</option>
                                                    <option value="FL">Florida</option>
                                                    <option value="GA">Georgia</option>
                                                    <option value="HI">Hawaii</option>
                                                    <option value="ID">Idaho</option>
                                                    <option value="IL">Illinois</option>
                                                    <option value="IN">Indiana</option>
                                                    <option value="IA">Iowa</option>
                                                    <option value="KS">Kansas</option>
                                                    <option value="KY">Kentucky</option>
                                                    <option value="LA">Louisiana</option>
                                                    <option value="ME">Maine</option>
                                                    <option value="MD">Maryland</option>
                                                    <option value="MA">Massachusetts</option>
                                                    <option value="MI">Michigan</option>
                                                    <option value="MN">Minnesota</option>
                                                    <option value="MS">Mississippi</option>
                                                    <option value="MO">Missouri</option>
                                                    <option value="MT">Montana</option>
                                                    <option value="NE">Nebraska</option>
                                                    <option value="NV">Nevada</option>
                                                    <option value="NH">New Hampshire</option>
                                                    <option value="NJ">New Jersey</option>
                                                    <option value="NM">New Mexico</option>
                                                    <option value="NY">New York</option>
                                                    <option value="NC">North Carolina</option>
                                                    <option value="ND">North Dakota</option>
                                                    <option value="OH">Ohio</option>
                                                    <option value="OK">Oklahoma</option>
                                                    <option value="OR">Oregon</option>
                                                    <option value="PA">Pennsylvania</option>
                                                    <option value="RI">Rhode Island</option>
                                                    <option value="SC">South Carolina</option>
                                                    <option value="SD">South Dakota</option>
                                                    <option value="TN">Tennessee</option>
                                                    <option value="TX">Texas</option>
                                                    <option value="UT">Utah</option>
                                                    <option value="VT">Vermont</option>
                                                    <option value="VA">Virginia</option>
                                                    <option value="WA">Washington</option>
                                                    <option value="WV">West Virginia</option>
                                                    <option value="WI">Wisconsin</option>
                                                    <option value="WY">Wyoming</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="space-2"></div>

                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="platform">Platform</label>

                                            <div class="col-xs-12 col-sm-9">
                                                <div class="clearfix">
                                                    <select class="input-medium" id="platform" name="platform">
                                                        <option value="">------------------</option>
                                                        <option value="linux">Linux</option>
                                                        <option value="windows">Windows</option>
                                                        <option value="mac">Mac OS</option>
                                                        <option value="ios">iOS</option>
                                                        <option value="android">Android</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-2"></div>

                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Comment</label>

                                            <div class="col-xs-12 col-sm-9">
                                                <div class="clearfix">
                                                    <textarea class="input-xlarge" name="comment" id="comment"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-8"></div>

                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-4 col-sm-offset-3">
                                                <label>
                                                    <input autocomplete="off" name="agree" id="agree" type="checkbox" class="ace" />
                                                    <span class="lbl"> I accept the policy</span>
                                                </label>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="step-pane" data-step="2">
                                    <div>
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert">
                                                <i class="ace-icon fa fa-times"></i>
                                            </button>

                                            <strong>
                                                <i class="ace-icon fa fa-check"></i>
                                                Well done!
                                            </strong>

                                            You successfully read this important alert message.
                                            <br />
                                        </div>

                                        <div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert">
                                                <i class="ace-icon fa fa-times"></i>
                                            </button>

                                            <strong>
                                                <i class="ace-icon fa fa-times"></i>
                                                Oh snap!
                                            </strong>

                                            Change a few things up and try submitting again.
                                            <br />
                                        </div>

                                        <div class="alert alert-warning">
                                            <button type="button" class="close" data-dismiss="alert">
                                                <i class="ace-icon fa fa-times"></i>
                                            </button>
                                            <strong>Warning!</strong>

                                            Best check yo self, you're not looking too good.
                                            <br />
                                        </div>

                                        <div class="alert alert-info">
                                            <button type="button" class="close" data-dismiss="alert">
                                                <i class="ace-icon fa fa-times"></i>
                                            </button>
                                            <strong>Heads up!</strong>

                                            This alert needs your attention, but it's not super important.
                                            <br />
                                        </div>
                                    </div>
                                </div>

                                <div class="step-pane" data-step="3">
                                    <div class="center">
                                        <h3 class="blue lighter">This is step 3</h3>
                                    </div>
                                </div>

                                <div class="step-pane" data-step="4">
                                    <div class="center">
                                        <h3 class="green">Congrats!</h3>
                                        Your product is ready to ship! Click finish to continue!
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr />
                        <div class="wizard-actions">
                            <button class="btn btn-prev">
                                <i class="ace-icon fa fa-arrow-left"></i>
                                Prev
                            </button>

                            <button class="btn btn-success btn-next" data-last="Finish">
                                Next
                                <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                            </button>
                        </div>
                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->
            </div>

            <div id="modal-wizard" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div id="modal-wizard-container">
                            <div class="modal-header">
                                <ul class="steps">
                                    <li data-step="1" class="active">
                                        <span class="step">1</span>
                                        <span class="title">Validation states</span>
                                    </li>

                                    <li data-step="2">
                                        <span class="step">2</span>
                                        <span class="title">Alerts</span>
                                    </li>

                                    <li data-step="3">
                                        <span class="step">3</span>
                                        <span class="title">Payment Info</span>
                                    </li>

                                    <li data-step="4">
                                        <span class="step">4</span>
                                        <span class="title">Other Info</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="modal-body step-content">
                                <div class="step-pane active" data-step="1">
                                    <div class="center">
                                        <h4 class="blue">Step 1</h4>
                                    </div>
                                </div>

                                <div class="step-pane" data-step="2">
                                    <div class="center">
                                        <h4 class="blue">Step 2</h4>
                                    </div>
                                </div>

                                <div class="step-pane" data-step="3">
                                    <div class="center">
                                        <h4 class="blue">Step 3</h4>
                                    </div>
                                </div>

                                <div class="step-pane" data-step="4">
                                    <div class="center">
                                        <h4 class="blue">Step 4</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer wizard-actions">
                            <button class="btn btn-sm btn-prev">
                                <i class="ace-icon fa fa-arrow-left"></i>
                                Prev
                            </button>

                            <button class="btn btn-success btn-sm btn-next" data-last="Finish">
                                Next
                                <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                            </button>

                            <button class="btn btn-danger btn-sm pull-left" data-dismiss="modal">
                                <i class="ace-icon fa fa-times"></i>
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div><!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    {{--Text-Area--}}

    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <h4 class="header green clearfix">
                Bootstrap Lightweight Editor
                <span class="block pull-right">
										<small class="grey middle">Choose style: &nbsp;</small>

										<span class="btn-toolbar inline middle no-margin">
											<span data-toggle="buttons" class="btn-group no-margin">
												<label class="btn btn-sm btn-yellow">
													1
													<input type="radio" value="1" />
												</label>

												<label class="btn btn-sm btn-yellow active">
													2
													<input type="radio" value="2" />
												</label>

												<label class="btn btn-sm btn-yellow">
													3
													<input type="radio" value="3" />
												</label>

												<label class="btn btn-sm btn-yellow">
													4
													<input type="radio" value="4" />
												</label>
											</span>
										</span>
									</span>
            </h4>

            <div class="wysiwyg-editor" id="editor1"></div>
        </div>
    </div>
    <!-- page specific plugin scripts -->
    <script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='{{ asset("assets/js/jquery.mobile.custom.min.js") }}'>"+"<"+"/script>");
    </script>


    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        jQuery(function($) {


            if(!ace.vars['touch']) {
                $('.chosen-select').chosen({allow_single_deselect:true});
                //resize the chosen on window resize

                $(window)
                    .off('resize.chosen')
                    .on('resize.chosen', function() {
                        $('.chosen-select').each(function() {
                            var $this = $(this);
                            $this.next().css({'width': $this.parent().width()});
                        })
                    }).trigger('resize.chosen');
                //resize chosen on sidebar collapse/expand
                $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
                    if(event_name != 'sidebar_collapsed') return;
                    $('.chosen-select').each(function() {
                        var $this = $(this);
                        $this.next().css({'width': $this.parent().width()});
                    })
                });


                $('#chosen-multiple-style .btn').on('click', function(e){
                    var target = $(this).find('input[type=radio]');
                    var which = parseInt(target.val());
                    if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
                    else $('#form-field-select-4').removeClass('tag-input-style');
                });
            }




            $('#id-input-file-1 , #id-input-file-2').ace_file_input({
                no_file:'No File ...',
                btn_choose:'Choose',
                btn_change:'Change',
                droppable:false,
                onchange:null,
                thumbnail:false //| true | large
                //whitelist:'gif|png|jpg|jpeg'
                //blacklist:'exe|php'
                //onchange:''
                //
            });
            //pre-show a file name, for example a previously selected file
            //$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])


            $('#id-input-file-3').ace_file_input({
                style: 'well',
                btn_choose: 'Drop files here or click to choose',
                btn_change: null,
                no_icon: 'ace-icon fa fa-cloud-upload',
                droppable: true,
                thumbnail: 'small'//large | fit
                //,icon_remove:null//set null, to hide remove/reset button
                /**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
                /**,before_remove : function() {
						return true;
					}*/
                ,
                preview_error : function(filename, error_code) {
                    //name of the file that failed
                    //error_code values
                    //1 = 'FILE_LOAD_FAILED',
                    //2 = 'IMAGE_LOAD_FAILED',
                    //3 = 'THUMBNAIL_FAILED'
                    //alert(error_code);
                }

            }).on('change', function(){
                //console.log($(this).data('ace_input_files'));
                //console.log($(this).data('ace_input_method'));
            });




            //datepicker plugin
            //link
            $('.date-picker').datepicker({
                autoclose: true,
                todayHighlight: true
            })
            //show datepicker when clicking on the icon
                .next().on(ace.click_event, function(){
                $(this).prev().focus();
            });

            //or change it into a date range picker
            $('.input-daterange').datepicker({autoclose:true});


            //to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
            $('input[name=date-range-picker]').daterangepicker({
                'applyClass' : 'btn-sm btn-success',
                'cancelClass' : 'btn-sm btn-default',
                locale: {
                    applyLabel: 'Apply',
                    cancelLabel: 'Cancel',
                }
            })
                .prev().on(ace.click_event, function(){
                $(this).next().focus();
            });


            $('#timepicker1').timepicker({
                minuteStep: 1,
                showSeconds: true,
                showMeridian: false,
                disableFocus: true,
                icons: {
                    up: 'fa fa-chevron-up',
                    down: 'fa fa-chevron-down'
                }
            }).on('focus', function() {
                $('#timepicker1').timepicker('showWidget');
            }).next().on(ace.click_event, function(){
                $(this).prev().focus();
            });




            if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
                //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
                icons: {
                    time: 'fa fa-clock-o',
                    date: 'fa fa-calendar',
                    up: 'fa fa-chevron-up',
                    down: 'fa fa-chevron-down',
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-arrows ',
                    clear: 'fa fa-trash',
                    close: 'fa fa-times'
                }
            }).next().on(ace.click_event, function(){
                $(this).prev().focus();
            });
        });
    </script>

@endsection
