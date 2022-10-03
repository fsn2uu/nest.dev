<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Edit My Company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('companies.edit') }}" method="post" enctype="multipart/form-data" id="infoForm">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="name">company name</label>
                                <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                value="{{ $company->name }}" />
                                @if($errors->has('name'))
                                    <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="address">address</label>
                                <input type="text" name="address" id="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                value="{{ $company->address }}" />
                                @if($errors->has('address'))
                                    <span class="invalid-feedback">{{ $errors->first('address') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="address2">address 2</label>
                                <input type="text" name="address2" id="address2" class="form-control {{ $errors->has('address2') ? 'is-invalid' : '' }}"
                                value="{{ $company->address2 }}" />
                                @if($errors->has('address2'))
                                    <span class="invalid-feedback">{{ $errors->first('address2') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="city">city</label>
                                <input type="text" name="city" id="city" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}"
                                value="{{ $company->city }}" />
                                @if($errors->has('city'))
                                    <span class="invalid-feedback">{{ $errors->first('city') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="zip">zip</label>
                                <input type="text" name="zip" id="zip" class="form-control {{ $errors->has('zip') ? 'is-invalid' : '' }}"
                                value="{{ $company->zip }}" />
                                @if($errors->has('zip'))
                                    <span class="invalid-feedback">{{ $errors->first('zip') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="phone">phone</label>
                                <input type="text" name="phone" id="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                value="{{ $company->phone }}" />
                                @if($errors->has('phone'))
                                    <span class="invalid-feedback">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="phone2">phone2</label>
                                <input type="text" name="phone2" id="phone2" class="form-control {{ $errors->has('phone2') ? 'is-invalid' : '' }}"
                                value="{{ $company->phone2 }}" />
                                @if($errors->has('phone2'))
                                    <span class="invalid-feedback">{{ $errors->first('phone2') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="toll_free">toll_free</label>
                                <input type="text" name="toll_free" id="toll_free" class="form-control {{ $errors->has('toll_free') ? 'is-invalid' : '' }}"
                                value="{{ $company->toll_free }}" />
                                @if($errors->has('toll_free'))
                                    <span class="invalid-feedback">{{ $errors->first('toll_free') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="website">website</label>
                                <input type="text" name="website" id="website" class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}"
                                value="{{ $company->website }}" />
                                @if($errors->has('website'))
                                    <span class="invalid-feedback">{{ $errors->first('website') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <input type="file" class="form-control-file" name="business_logo" id="logo">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="$('#infoForm').submit()">Save changes</button>
            </div>
        </div>
    </div>
</div>
