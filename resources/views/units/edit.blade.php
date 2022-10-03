@extends('_default')

@section('content')

    <h1>
        Edit {{ $unit->name }}
        @if (\Auth::user()->canDeleteUnits())
            <a href="{{ route('units.delete', $unit->id) }}" class="btn btn-danger float-right" onclick="return conf2();">Delete Unit</a>
        @endif
    </h1>

    <ul class="nav nav-tabs mt-3" id="unitInfo" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Info</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="photos-tab" data-toggle="tab" href="#photos" role="tab" aria-controls="photos" aria-selected="false">Photos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Settings</a>
        </li>
    </ul>

    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="tab-content mt-2" id="unitInfoContent">
            <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                <div class="row">
                    <div class="col-xs-12 col-md-8">
                        <h4>Unit Information</h4>
                        <div class="form-group">
                            <label for="name">name</label>
                            <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            value="{{ old('name') ?: $unit->name }}" />
                            @if($errors->has('name'))
                                <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-8">
                        <h4>Location Information</h4>
                        <div class="form-group">
                            <label for="address">address</label>
                            <input type="text" name="address" id="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                            value="{{ old('address') ?: $unit->address }}" />
                            @if($errors->has('address'))
                                <span class="invalid-feedback">{{ $errors->first('address') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="address2">address 2</label>
                            <input type="text" name="address2" id="address2" class="form-control {{ $errors->has('address2') ? 'is-invalid' : '' }}"
                            value="{{ old('address2') ?: $unit->address2 }}" placeholder="Suite #, Apt #, etc." />
                            @if($errors->has('address2'))
                                <span class="invalid-feedback">{{ $errors->first('address2') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="city">city</label>
                            <input type="text" name="city" id="city" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}"
                            value="{{ old('city') ?: $unit->city }}" />
                            @if($errors->has('city'))
                                <span class="invalid-feedback">{{ $errors->first('city') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="state">state</label>
                            <select name="state" id="state" class="form-control {{ $errors->has('state') ? 'has-error' : '' }}">
                                <option value="AL">Alabama</option>
                                <option value="AK">Alaska</option>
                                <option value="AZ">Arizona</option>
                                <option value="AR">Arkansas</option>
                                <option value="CA">California</option>
                                <option value="CO">Colorado</option>
                                <option value="CT">Connecticut</option>
                                <option value="DE">Delaware</option>
                                <option value="DC">District of Columbia</option>
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
                            @if($errors->has('state'))
                                <span class="invalid-feedback">{{ $errors->first('state') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="zip">zip</label>
                            <input type="text" name="zip" id="zip" class="form-control {{ $errors->has('zip') ? 'is-invalid' : '' }}"
                            value="{{ old('zip') ?: $unit->zip }}" />
                            @if($errors->has('zip'))
                                <span class="invalid-feedback">{{ $errors->first('zip') }}</span>
                            @endif
                        </div>
                        <h4 class="mt-2">Description</h4>
                        <div class="form-group">
                            <label for="description">unit description</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control
                            {{ $errors->has('content') ? 'is-invalid' : '' }}">{{ old('description') ?: $unit->description }}</textarea>
                            @if($errors->has('description'))
                                <span class="invalid-feedback">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <h4 class="mt-2">Amenities</h4>
                <div class="form-group">
                    <label for="amenities"></label>
                    <select name="amenities[]" id="amenities" class="form-control {{ $errors->has('amenities') ? 'has-error' : '' }}" multiple>
                        @foreach (\App\Amenity::where('type', 'c')->orderBy('name')->get() as $r)
                            <option value="{{ $r->id }}" {{ $unit->amenities()->where('amenity_id', $r->id)->count() > 0 ? 'selected' : '' }}>{{ $r->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('amenities'))
                        <span class="invalid-feedback">{{ $errors->first('amenities') }}</span>
                    @endif
                </div>
            </div>

            <div class="tab-pane fade" id="photos" role="tabpanel" aria-labelledby="photos-tab">
                @if ($unit->photos->count() > 0)
                    <div class="card-deck">
                        @foreach ($unit->photos as $pic)
                            <div class="card" data-id="{{ $pic->id }}">
                                <img src="{{ asset('storage/'.\Auth::user()->company_id.'/units/'.$unit->id.'/'.$pic->filename) }}" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $pic->filename }}</h5>
                                    <p class="card-text">Alt: {{ $pic->alt }}</p>
                                    <p class="card-text">Title: {{ $pic->title }}</p>
                                    <p class="card-text">Order: {{ $pic->order }}</p>
                                </div>
                                <div class="card-footer">
                                    <a href="" class="btn btn-light float-right" data-target="#photoEditModal" data-toggle="modal"
                                    data-path="{{ asset('storage/'.\Auth::user()->company_id.'/unites/'.$unit->id.'/'.$pic->filename) }}"
                                        data-alt="{{ $pic->alt }}" data-title="{{ $pic->title }}" data-id="{{ $pic->id }}"><i class="far fa-edit"></i></a>
                                    <a href="" class="btn btn-light float-right mr-2 killer"><i class="far fa-trash-alt"></i></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="row">
                        <div class="col-xs-12 col-md-8">
                            <p>There are no photos for this unit yet.  Upload some to get started:</p>
                            <label>Unit Photos</label>
                            <div class="custom-file mb-3">
                                <input type="file" name="photos[]" class="custom-file-input" id="photos" multiple>
                                <label class="custom-file-label" for="photos">Choose files</label>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row mt-5">
                    <div class="col-xs-12 col-md-8">
                        <label>Add Unit Photos</label>
                        <div class="custom-file mb-3">
                            <input type="file" name="photos[]" class="custom-file-input" id="photos" multiple>
                            <label class="custom-file-label" for="photos">Choose files</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                <div class="col-xs-12 col-md-8">
                    <div class="form-group">
                        <label for="status">status</label>
                        <select name="status" id="status" class="form-control {{ $errors->has('status') ? 'has-error' : '' }}">
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : $unit->status == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : $unit->status == 'active' ? 'selected' : '' }}>Active</option>
                        </select>
                        <span class="feedback">Only active units will be shown</span>
                        @if($errors->has('status'))
                            <span class="invalid-feedback">{{ $errors->first('status') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <input type="submit" value="Edit Unit" class="btn btn-primary mt-5">
    </form>

@endsection

@section('scripts')

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
    $( function() {
        $('#amenities').multiselect({
            nonSelectedText: 'Select Amenities',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true
        })

        $( ".card-deck" ).sortable({
            stop: function(event, ui)
                {
                    $('.card').each(function(i, obj){
                    axios.post('{{ route('photos.update') }}', {
                        id: $(this).data('id'),
                        order: i
                    })
                    .then(function(){
                        //console.log('it worked')
                    })
                    .catch(function(error){
                        console.log(error)
                    })
                })
            }
        })

        $( ".card-deck" ).disableSelection();

        $('#photoEditModal').on('show.bs.modal', function(e){
            var link = $(e.relatedTarget)
            var modal = $(this)
            modal.find('#imageHolder').append('<img src="'+ link.data('path') +'" style="width:inherit;" />')
            modal.find('#editAlt').val(link.data('alt'))
            modal.find('#editTitle').val(link.data('title'))
            modal.find('.killButton').attr('data-id', link.data('id'))
        })

        $('#photoEditModal').on('hide.bs.modal', function(e){
            var modal = $(this)
            modal.find('#imageHolder img').remove()
            modal.find('#editAlt').val('')
            modal.find('#editTitle').val('')
            modal.find('.killButton').attr('data-id', '')
        })

        $('.killButton').on('click', function(e){
            console.log('hi')
            e.preventDefault()
            if(conf() === true)
            {
                var id = $(this).data('id')
                killCommand(id)
                $('.card-deck').find(`[data-id='${id}']`).remove()
                $('#photoEditModal').modal('hide')
            }
            else
            {
                return false
            }
        })
    })

    $('.killer').on('click', function(e){
        e.preventDefault()
        if(conf() === true)
        {
            killCommand($(this).data('id'))
        }
        else
        {
            return false
        }
    })

    function killCommand(id)
    {
        axios.post('{{ route('photos.delete') }}', {
            id: id,
            unit_id: {{ $unit->id }}
        })
        .catch(function(error){
            console.log(error)
        })
    }

    function conf()
    {
        if(confirm('Are you sure?') === false)
        {
            return false;
        }
        return true;
    }

    function conf2()
    {
        if(confirm('Are you sure? This will also delete any units attached to this unit, and this can\'t be undone.') === false)
        {
            return false;
        }

        return true;
    }
  </script>

    <div class="modal fade" tabindex="-1" role="dialog" id="photoEditModal" aria-labelledby="photoEditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6" id="imageHolder"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Alt Text</label>
                                    <input type="text" id="editAlt" class="form-control" value="" />
                                </div>
                                <div class="form-group">
                                    <label for="">Title Text</label>
                                    <input type="text" id="editTitle" class="form-control" value="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger killButton" type="button" data-id=""><i class="far fa-trash-alt"></i> Delete Photo</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="button">Edit Photo</button>
                </div>
            </div>
        </div>
    </div>

@endsection
