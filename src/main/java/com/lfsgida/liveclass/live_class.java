package com.lfsgida.liveclass;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.opengl.Visibility;
import android.os.Bundle;
import android.os.Handler;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.material.bottomnavigation.BottomNavigationView;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

import us.zoom.sdk.JoinMeetingOptions;
import us.zoom.sdk.JoinMeetingParams;
import us.zoom.sdk.MeetingService;
import us.zoom.sdk.MeetingViewsOptions;
import us.zoom.sdk.ZoomSDK;
import us.zoom.sdk.ZoomSDKInitParams;
import us.zoom.sdk.ZoomSDKInitializeListener;

public class live_class extends AppCompatActivity {

    TextView std_name,std_admno,std_class;
    Button join,das;
    String user_c="8";
    ProgressBar pb;

    String sec="A";
    Session_class obs;
    int splash=2000;

    String meeting_id="vi;'lkjhgek",meeting_pass="sdfsdf";

    private String URL_LOGIN2="http://lfsgida.online//getidpassword.php";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        //getIdpassword();
        setContentView(R.layout.activity_live_class);


    }
    @Override
    public void onResume(){
        super.onResume();
        setContentView(R.layout.activity_live_class);
        obs=new Session_class(getApplicationContext());


        std_name = findViewById(R.id.student_name);
        pb=findViewById(R.id.progressBar);
        std_admno = findViewById(R.id.student_admno);
        std_class = findViewById(R.id.student_class);
        join=findViewById(R.id.join_live);
        das=findViewById(R.id.das);
        join.setVisibility(View.GONE);
        SharedPreferences sp=obs.getShare();
        std_name.setText(sp.getString("user_Name", ""));
        std_admno.setText(sp.getString("user_id", ""));
        user_c=sp.getString("user_class", "");
        String value="class :" + user_c + " sec :" + sp.getString("user_sec", "");
        intializeZoom(this);




        das.setOnClickListener(view ->  {


           // obs.das(getApplicationContext());
            Intent intent=new Intent(getApplicationContext(),dashboard.class);
            intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP+Intent.FLAG_ACTIVITY_NEW_TASK);
            startActivity(intent);

        });



        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                getIdpassword();
                pb.setVisibility(View.GONE);
            }
        },splash);


        std_class.setText(value);


        join.setOnClickListener(view ->joinMeeting(this) );


    }
    public void joinMeeting(Context context)
    {


        MeetingService meetingService= ZoomSDK.getInstance().getMeetingService();
        JoinMeetingOptions options=new JoinMeetingOptions();
        JoinMeetingParams params=new JoinMeetingParams();
        String value=user_c +" "+sec +" - "+std_name.getText()+" ("+std_admno.getText()+ ")";

        params.displayName=value;
        options.meeting_views_options= MeetingViewsOptions.NO_TEXT_MEETING_ID+MeetingViewsOptions.NO_TEXT_PASSWORD;
        options.no_invite=true;
        options.custom_meeting_id="VIVEK ";
        options.no_share=true;
        options.no_driving_mode=true;
        params.meetingNo=meeting_id;
        params.password=meeting_pass;
        try {
            meetingService.joinMeetingWithParams(context,params,options);
        }
        catch(RuntimeException e) {

            meetingService.joinMeetingWithParams(context, params, options);

        }
        catch(Exception e)
        {
            meetingService.joinMeetingWithParams(context, params, options);
        }


    }
    private void intializeZoom(Context context)
    {
        // params.appKey="ntfAmjRu5Yu6XOaCp0CPiX54Vs1HeVUytgWA";
        //        params.appSecret="kHrMpRqffy7bvKV4oyxDMl1ugStnSYTB7Q5t";
        ZoomSDK sdk= ZoomSDK.getInstance();
        if(!sdk.isInitialized()) {
            sdk= ZoomSDK.getInstance();
            join.setVisibility(View.GONE);


        }
        else {

            if(sdk.isInitialized()) {
                join.setVisibility(View.VISIBLE);
            }
        }

        ZoomSDKInitParams params=new ZoomSDKInitParams();
        params.appKey="XBzFCaUg90nLFlXYbR74re3HxLHP7KU37CYu";
        params.appSecret="yCiCFAHnpPwLtQRXU4w6R6yPyFzQNyv4OeWd";
        params.domain="zoom.us";
        params.enableLog=true;
        ZoomSDKInitializeListener listener=new ZoomSDKInitializeListener() {
            @Override
            public void onZoomSDKInitializeResult(int i, int i1) {

            }

            @Override
            public void onZoomAuthIdentityExpired() {

            }
        };
        try {
            sdk.initialize(context,listener,params);
        }
        catch(Exception e)
        {
            sdk.initialize(context,listener,params);
        }




    }
    void getIdpassword()
    {

        StringRequest stringRequest = new StringRequest(Request.Method.POST, URL_LOGIN2,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {

                            JSONObject jsonObject = new JSONObject(response);
                           // Toast.makeText(getApplicationContext(),jsonObject.getString("meeting_id"),Toast.LENGTH_LONG).show();
                            String a=jsonObject.getString("meeting_id");
                            String b = jsonObject.getString("meeting_pass");
                            set_meet(a,b);

                            //;
                        }catch (JSONException e) {
                            Toast.makeText(getApplicationContext(),e.toString(),Toast.LENGTH_LONG).show();
                            e.printStackTrace();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getApplicationContext(), " Response Error in Login " + error.toString(), Toast.LENGTH_LONG).show();
                    }
                }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("class", user_c);
                params.put("Password", sec);
                return params;
            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
        requestQueue.add(stringRequest);
    }
    public void set_meet(String a,String b)
    {
        meeting_id=a;
        meeting_pass=b;
        join.setVisibility(View.VISIBLE);
    }





}