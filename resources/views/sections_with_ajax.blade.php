<!-- Grid Tab -->

<div class="tab-pane fade show active grid_body" id="homec-grid" role="tabpanel">
    <div class="row">
        @foreach ($sections as $section)
        @if($section->sub->status)
        <div class="col-md-6 col-12 mg-top-30">
            <!-- Single property-->
            <a href="{{" /section/$section->id" }}">
            <div class="homec-property">
                <!-- Property Head-->
                <div class="homec-property__head">
                    <img src="{{ asset($section->image) }}">
                    <!-- Top Sticky -->
                    <div class="homec-property__hsticky">


                    </div>
                    <!-- End Top Sticky -->
                </div>
                <!-- Property Body-->
                <div class="homec-property__body">


                    <h3 class="homec-property__title">{{
                            ($section->name) }}</h3>
                    <div class="homec-property__text">
                        <img src="{{ asset('frontend/img/location-icon.svg') }}" alt="address">
                        <p>{{ $section->city->name }}</p>
                    </div>
                    <!-- Property List-->

                </div>
            </div>
            <!-- End Single property-->
        </a>
        </div>
        @endif
        @endforeach
    </div>
    <div class="row mg-top-40">
        {{ $sections->links('ajax_custom_pagination') }}
    </div>
</div>
<!-- End Grid Tab -->
<!-- List Tab -->
<div class="tab-pane fade list_body" id="homec-list" role="tabpanel">

    <div class="row">
        @foreach ($sections as $section)
        <div class="col-12 mg-top-30">
            <!-- Single property-->
            <div class="homec-property homec-property__list-style">
                <!-- Property Head-->
                <div class="homec-property__head">
                    <img src="{{ asset($section->image) }}">
                    <!-- Top Sticky -->

                    <!-- End Top Sticky -->
                </div>
                <!-- Property Body-->
                <div class="homec-property__body">


                    <h3 class="homec-property__title"><a href="{{ "/section/$section->id" }}">{{
                            html_decode($section->name) }}</a></h3>
                    <div class="homec-property__text">
                        <img src="{{ asset('frontend/img/location-icon.svg') }}" alt="address">
                        <p>{{ html_decode($section->city->name) }}</p>
                    </div>

                    <!-- Property List-->

                </div>
            </div>
            <!-- End Single property-->
        </div>
        @endforeach
    </div>
    <div class="row mg-top-40">
        {{ $sections->links('ajax_custom_pagination') }}
    </div>
</div>
<!-- End List Tab -->


<script>
    (function($) {
        "use strict";
        $(document).ready(function () {
            $(".add-to-wishlist").on("click", function(){

                var isDemo = "{{ env('APP_MODE') }}"
                if(isDemo == 'DEMO'){
                    toastr.error('This Is Demo Version. You Can Not Change Anything');
                    return;
                }

                let property_id = $(this).data('property-id');

                $.ajax({
                    type: 'get',
                    url: "{{ url('/user/add-to-wishlist') }}" + "/" + property_id,
                    success: function (response) {
                        toastr.success(response.message)
                    },
                    error: function(err) {
                        if(err.status == 401){
                            toastr.error("{{__('user.Please login first')}}")
                        }

                        if(err.status == 403){
                            let erro_message = err.responseJSON.message
                            toastr.error(erro_message)
                        }
                    }
                });


            })
        });
    })(jQuery);

</script>
