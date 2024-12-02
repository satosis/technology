@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h2 class="heading-section"> What do you want to test ?</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <a href="/payment">
                    <button type="button" class="btn btn-white w-100 align-items-stretch d-flex">
                        <div class="icon icon-left icon-primary d-flex align-items-center justify-content-center">
                            <i class="ion-ios-cash"></i>
                        </div>
                        <div class="text text-right">
                            <h4>6</h4>
                            <span>Payment</span>
                        </div>
                    </button>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="/login">
                    <button type="button" class="btn btn-white w-100 align-items-stretch d-flex">
                        <div class="icon icon-left icon-quarternary d-flex align-items-center justify-content-center">
                            <i class="ion-ios-people"></i>
                        </div>
                        <div class="text text-right">
                            <h4>3</h4>
                            <span>Login</span>
                        </div>
                    </button>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="/chat">
                    <button type="button" class="btn btn-white w-100 align-items-stretch d-flex">
                        <div class="icon icon-left icon-secondary d-flex align-items-center justify-content-center">
                            <i class="ion-ios-chatboxes"></i>
                        </div>
                        <div class="text text-right">
                            <h4>4</h4>
                            <span>Chat</span>
                        </div>
                    </button>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="/video">
                    <button type="button" class="btn btn-white w-100 align-items-stretch d-flex">
                        <div class="icon icon-left icon-tertiary d-flex align-items-center justify-content-center">
                            <i class="ion-ios-pulse"></i>
                        </div>
                        <div class="text text-right">
                            <h4>1</h4>
                            <span>Video Call</span>
                        </div>
                    </button>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="/sms">
                    <button type="button" class="btn btn-white w-100 align-items-stretch d-flex">
                        <div class="text text-left">
                            <h4>1</h4>
                            <span>SMS</span>
                        </div>
                        <div class="icon icon-right icon-primary d-flex align-items-center justify-content-center">
                            <i class="ion-ios-chatboxes"></i>
                        </div>
                    </button>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="/image">
                    <button type="button" class="btn btn-white w-100 align-items-stretch d-flex">
                        <div class="text text-left">
                            <h4>1</h4>
                            <span>Resize Image</span>
                        </div>
                        <div class="icon icon-right icon-quarternary d-flex align-items-center justify-content-center">
                            <i class="ion-ios-image"></i>
                        </div>
                    </button>
                </a>
            </div>

            <div class="col-md-3 mb-3">
                <a href="/date">
                    <button type="button" class="btn btn-white w-100 align-items-stretch d-flex">
                        <div class="text text-left">
                            <h4>1</h4>
                            <span>DatePicker</span>
                        </div>
                        <div class="icon icon-right icon-secondary d-flex align-items-center justify-content-center">
                            <i class="ion-ios-calendar"></i>
                        </div>
                    </button>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="/ads">
                    <button type="button" class="btn btn-white w-100 align-items-stretch d-flex">
                        <div class="text text-left">
                            <h4>1</h4>
                            <span>Ads</span>
                        </div>
                        <div class="icon icon-right icon-tertiary d-flex align-items-center justify-content-center">
                            <i class="ion-ios-pricetag"></i>
                        </div>
                    </button>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <button type="button" class="btn btn-primary w-100 align-items-stretch d-flex">
                    <div class="icon icon-left d-flex align-items-center justify-content-center">
                        <i class="ion-ios-brush"></i>
                    </div>
                    <div class="text text-right">
                        <h4>275</h4>
                        <span>New Posts</span>
                    </div>
                </button>
            </div>
            <div class="col-md-3 mb-3">
                <button type="button" class="btn btn-secondary w-100 align-items-stretch d-flex">
                    <div class="icon icon-left d-flex align-items-center justify-content-center">
                        <i class="ion-ios-chatboxes"></i>
                    </div>
                    <div class="text text-right">
                        <h4>109</h4>
                        <span>New Comment</span>
                    </div>
                </button>
            </div>
            <div class="col-md-3 mb-3">
                <button type="button" class="btn btn-tertiary w-100 align-items-stretch d-flex">
                    <div class="icon icon-left d-flex align-items-center justify-content-center">
                        <i class="ion-ios-pulse"></i>
                    </div>
                    <div class="text text-right">
                        <h4>68 %</h4>
                        <span>Bounce Rate</span>
                    </div>
                </button>
            </div>
            <div class="col-md-3 mb-3">
                <button type="button" class="btn btn-quarternary w-100 align-items-stretch d-flex">
                    <div class="icon icon-left d-flex align-items-center justify-content-center">
                        <i class="ion-ios-people"></i>
                    </div>
                    <div class="text text-right">
                        <h4>343</h4>
                        <span>Total Visits</span>
                    </div>
                </button>
            </div>

            <div class="col-md-3 mb-3">
                <button type="button" class="btn btn-quarternary w-100 align-items-stretch d-flex">
                    <div class="text text-left">
                        <h4>275</h4>
                        <span>New Projects</span>
                    </div>
                    <div class="icon icon-right d-flex align-items-center justify-content-center">
                        <i class="ion-ios-briefcase"></i>
                    </div>
                </button>
            </div>
            <div class="col-md-3 mb-3">
                <button type="button" class="btn btn-primary w-100 align-items-stretch d-flex">
                    <div class="text text-left">
                        <h4>109</h4>
                        <span>New Clients</span>
                    </div>
                    <div class="icon icon-right d-flex align-items-center justify-content-center">
                        <i class="ion-ios-people"></i>
                    </div>
                </button>
            </div>
            <div class="col-md-3 mb-3">
                <button type="button" class="btn btn-secondary w-100 align-items-stretch d-flex">
                    <div class="text text-left">
                        <h4>68 %</h4>
                        <span>Conversion Rate</span>
                    </div>
                    <div class="icon icon-right d-flex align-items-center justify-content-center">
                        <i class="ion-ios-pulse"></i>
                    </div>
                </button>
            </div>
            <div class="col-md-3 mb-3">
                <button type="button" class="btn btn-tertiary w-100 align-items-stretch d-flex">
                    <div class="text text-left">
                        <h4>343</h4>
                        <span>Support Tickets</span>
                    </div>
                    <div class="icon icon-right d-flex align-items-center justify-content-center">
                        <i class="ion-ios-pricetag"></i>
                    </div>
                </button>
            </div>
        </div>
    </div>
    @endsection
