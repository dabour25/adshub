@extends('layouts/app')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Create New Ad</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>Create New Ad</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
        <div class="container">
            <form action="create-ad" method="post" enctype="multipart/form-data">
                <label>Select Ad type</label>
                <select name="ad-type" id="type" class="form-control">
                    <option value="">Select Type</option>
                    <option value="image">Image</option>
                    <option value="page">Web Page</option>
                    <option value="youtube">Youtube Video</option>
                    <option value="video" disabled>Video (Soon)</option>
                </select>
                <div id="image-div" style="display: none;">
                    <label>Ad title</label>
                    <input type="text" class="form-control" name="title">
                    <label>Total Cost</label>
                    <input type="text" class="form-control" name="total_cost" placeholder="You have balance {{auth()->user()->balance}} EGP">
                    <label>Max Time (seconds):</label>
                    <input type="text" class="form-control" name="max_time" placeholder="max value is 30s">
                    <label>Image Clickable Link (redirect)</label>
                    <input type="text" class="form-control" name="link" placeholder="enter your web url or leave empty">
                    <label>Image (Ad):</label>
                    <input type="file" class="form-control" name="ad_view">
                    <button class="btn btn-success my-2" type="submit">Create Ad</button>
                </div>
                <div id="page-div" style="display: none;">
                    <label>Ad title</label>
                    <input type="text" class="form-control" name="title">
                    <label>Total Cost</label>
                    <input type="text" class="form-control" name="total_cost" placeholder="You have balance {{auth()->user()->balance}} EGP">
                    <label>Max visit Time (seconds):</label>
                    <input type="text" class="form-control" name="max_time" placeholder="max value is 40s">
                    <label>URL (Ad):</label>
                    <input type="text" class="form-control" name="ad_view" placeholder="enter your web url or leave empty">
                    <button class="btn btn-success my-2" type="submit">Create Ad</button>
                </div>
                <div id="youtube-div" style="display: none;">
                    <label>Ad title</label>
                    <input type="text" class="form-control" name="title">
                    <label>Total Cost</label>
                    <input type="text" class="form-control" name="total_cost" placeholder="You have balance {{auth()->user()->balance}} EGP">
                    <label>Max watch Time (seconds):</label>
                    <input type="text" class="form-control" name="max_time" placeholder="max value is 180s">
                    <label>Video URL (Ad):</label>
                    <input type="text" class="form-control" name="ad_view" placeholder="enter your web url or leave empty">
                    <label>Channel URL (optional):</label>
                    <input type="text" class="form-control" name="link" placeholder="enter your channel url,Subscribe link">
                    <button class="btn btn-success my-2" type="submit">Create Ad</button>
                </div>
            </form>
        </div>
    </section>
    <script>
        $("#type").change(function () {
           if($("#type").val()=="image"){
               $("#image-div").show();
               $("#page-div").hide();
               $("#youtube-div").hide();
           }else if($("#type").val()=="page"){
               $("#image-div").hide();
               $("#page-div").show();
               $("#youtube-div").hide();
           }else if($("#type").val()=="youtube"){
               $("#image-div").hide();
               $("#page-div").hide();
               $("#youtube-div").show();
           }else{
               $("#image-div").hide();
               $("#page-div").hide();
               $("#youtube-div").hide();
           }
        });
    </script>
@stop
