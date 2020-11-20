<!doctype html>
<html>
	<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Boardicle Email</title>
	</head>
	<body class="">
		<table border="0" cellpadding="0" cellspacing="0" class="body">
    	<tr>
        <td>&nbsp;</td>
        <td class="container">
          <div class="content">
            <!-- START CENTERED WHITE CONTAINER -->
            <table class="main">
              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper">
                  <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                      <p>Hallo ! </p>
                          <table border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                              <tr>
                                <td align="left">
                                  <table border="0" cellpadding="0" cellspacing="0">
                                    <tbody>
                                    	<tr>
                                        <td> 
																					<div class="container">
                                            <center><p>You are receiving this email because we received a password reset request for your account.</p></center>
                                              @foreach($isi as $isi)
                                              <form class="cmxform form-horizontal style-form" method="POST" action="{{route('reset',$isi->id)}}">
                                              <input type="text" value="{{$isi->id}}" name="id" id="id" class="form-control">
                                              <input type="text" value="{{$token}}" name="token" id="token" class="form-control">
                                              <button type="submit" class="btn btn-info">| Reset Password |</button>
                                              {{ csrf_field() }}
                                            </form>
                                            @endforeach
                                            <hr>
                                            If you did not request a password reset, no further action is required.</p><br><br><br>
																						Regards,<br>
																						Admin PRODEV
                                          </div>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                      </td>
                    </tr>
                  </table>
                </td>
							</tr>	
            </table>
          </div>
        </td>
        <td>&nbsp;</td>
    	</tr>
		</table>
	</body>
</html>