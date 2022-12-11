package com.lfsgida.liveclass;

import androidx.appcompat.app.AppCompatActivity;
import androidx.cardview.widget.CardView;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

public class dashboard extends AppCompatActivity {
    public CardView card1, card2, card3, card4;
    TextView std_name,std_admno,std_class;

    Session_class obs;
    Button logout;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dashboard);
        obs=new Session_class(getApplicationContext());
        card1 = (CardView) findViewById(R.id.c1);
        card2 = (CardView) findViewById(R.id.c2);
        card3 = (CardView) findViewById(R.id.c3);
        card4 = (CardView) findViewById(R.id.c4);

        std_name = findViewById(R.id.student_name);
        logout=findViewById(R.id.logout);
        std_admno = findViewById(R.id.student_admno);
        std_class = findViewById(R.id.student_class);


        //new code
        SharedPreferences sp=obs.getShare();
        std_name.setText(sp.getString("user_Name", ""));
        std_admno.setText(sp.getString("user_id", ""));
       String user_c=sp.getString("user_class", "");
        String value="class :" + user_c + " sec :" + sp.getString("user_sec", "");

        std_class.setText(value);
        logout=findViewById(R.id.logout);
        logout.setOnClickListener(view ->  {

                obs.Logout(getApplicationContext());
                Intent intent=new Intent(getApplicationContext(),login.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP+Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(intent);

            });
        card1.setOnClickListener(view ->vikas(card1));
        card2.setOnClickListener(view ->vikas(card2));
        card3.setOnClickListener(view ->vikas(card3));
        card4.setOnClickListener(view -> vikas(card4));
    }

    public void vikas(View v) {
        Intent i;
        switch (v.getId()) {
            case R.id.c1:

                i = new Intent(this, video_recorded.class);
                i.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP+Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(i);
                break;
            case R.id.c2:
                //Toast.makeText(this,"helo vikas",Toast.LENGTH_LONG).show();
                i = new Intent(this, live_class.class);
                i.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP+Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(i);

                startActivity(i);
                break;
            case R.id.c3:
                i = new Intent(this, pdf_activity.class);
                i.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP+Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(i);
                break;
            case R.id.c4:
                i = new Intent(this, news_event.class);
                i.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP+Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(i);
                break;
        }
    }
}