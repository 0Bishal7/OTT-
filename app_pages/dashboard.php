
    <section class="content-header">
      <h1>
        Welcome to <?=$CompanyName;?> Support
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=$URL?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-ticket"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Tickets</span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-calendar"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Today's Tickets</span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-calendar-check-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Today's Resolved</span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-star"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Feedback</span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-hourglass-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Pending</span>
              <span class="info-box-number">41,410</span>
            </div>
          </div>
        </div>
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-calendar-check-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Resolved</span>
              <span class="info-box-number">760</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-times"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Rejected</span>
              <span class="info-box-number">2,000</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-hourglass-end"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">In Progress</span>
              <span class="info-box-number">2,000</span>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <!-- <form action="https://nodejsapi.architecture.care/uploadfiles/upload" method="post" enctype="multipart/form-data">
            <input type="text" class="form-control" name="directory">
            <input type="file" name="filename">
            <button class="btn btn-primary" type="submit">Get Fileurl</button>
          </form> -->
          <form id="uploadForm">
            <input type="text" class="form-control" name="directory" id="directory" placeholder="Enter directory">
            <input type="file" name="filename" id="filename">
            <button class="btn btn-primary" type="button" onclick="uploadFile()">Get Fileurl</button>
          </form>
        </div>
      </div>
    </section>


    <script src="<?=$URL;?>js/dashboard.js"></script>