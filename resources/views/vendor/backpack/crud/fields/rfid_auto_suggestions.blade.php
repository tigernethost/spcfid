<!-- Your new field type -->
{{--   <div class="form-group">
    <label>{{ $field['label'] }}</label>
    <input
        type="text"
        class="form-control"

        @foreach ($field as $attribute => $value)
            @if (is_string($attribute) && is_string($value))
               @if($attribute == 'value')
                    {{ $attribute }}="{{ old($field['name']) ? old($field['name']) : $value }}"
                @else
                    {{ $attribute }}="{{ $value }}"
                @endif
            @endif
        @endforeach
        >
  </div> --}}

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))

    {{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
				{{-- YOUR CSS HERE --}}
				{{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}
				<link rel="stylesheet" href="{{ asset('css/jquery.auto-complete.css') }}">
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
    		{{-- YOUR JS HERE --}}
			<script src="{{ asset('js/jquery.auto-complete.js') }}"></script>
			  {{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> --}}
  			{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
    		<script>
    			
				$('input[name=member_id]').after('\
					<span id="fullName"></span>\
				');


				var options = {
						url: "http://127.0.0.1:8000/api/getallusers",

						getValue: function(element) {
							return element.member_id + ' ' + element.firstname + ' ' + element.middlename + ' ' + element.lastname;
							// return $(element).find("name").text();
						},

						list: {
							match: {
								enabled: true
							},
							onSelectItemEvent: function() {
								var value = $("input[name=member_id]").getSelectedItemData();
								// console.log(value);	
								$("input[name=member_id]").val(value.member_id).trigger("change");
								$('#fullName').text(value.firstname + ' ' + value.middlename + ' ' + value.lastname).trigger("change");
								// $("#data-holder").val(value).trigger("change");
							},
							showAnimation: {
								type: "fade", //normal|slide|fade
								time: 400,
								callback: function() {}
							}
						}
					};
			    $('input[name=member_id]').easyAutocomplete(options);
    		</script>
    @endpush

@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}