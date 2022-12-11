package com.lfsgida.liveclass;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.material.button.MaterialButton;
import com.google.android.material.textfield.TextInputEditText;

import java.util.HashMap;
import java.util.Map;

public class login extends AppCompatActivity {

    TextInputEditText u_name, u_password;
    MaterialButton lg_btn;
    private ProgressBar loading;
    private final String URL_LOGIN = "http://lfsgida.online//vivek_login.php";
    String uname = "";
    Session_class ob;
    String passwrod = "";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        ob = new Session_class(getApplicationContext());
        if (ob.getSessionId() == 1) {
            Intent intent = new Intent(getApplicationContext(), dashboard.class);
            intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK + Intent.FLAG_ACTIVITY_CLEAR_TOP);
            startActivity(intent);
        }


        u_name = findViewById(R.id.user_name);
        u_password = findViewById(R.id.user_password);
        lg_btn = findViewById(R.id.login_btn);
        loading = findViewById(R.id.pbar);
        lg_btn.setOnClickListener(view -> check_login());

    }
public void check_login()
{
    uname = u_name.getText().toString();
    passwrod = u_password.getText().toString();
    if (uname.isEmpty() || passwrod.isEmpty()) {
        Toast.makeText(getApplicationContext(), " Please Fill all the fields",
                Toast.LENGTH_LONG).show();
    } else
        login_do(uname, passwrod);
}
    private void login_do(String User_name, String Password) {
        loading.setVisibility(View.VISIBLE);
        lg_btn.setVisibility(View.GONE);

        StringRequest stringRequest = new StringRequest(Request.Method.POST, URL_LOGIN,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        loading.setVisibility(View.GONE);
                        lg_btn.setVisibility(View.GONE);
                        String message=ob.SaveSession(getApplicationContext(),response);
                        if (message.equals("success")) {
                            Intent intent=new Intent(getApplicationContext(),dashboard.class);
                            intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK+Intent.FLAG_ACTIVITY_NEW_TASK);
                            startActivity(intent);

                        }
                        else if(message.equals("Login"))
                        {
                            Toast.makeText(getApplicationContext(),"Already Login in Some other device",Toast.LENGTH_LONG).show();
                            loading.setVisibility(View.GONE);
                            lg_btn.setVisibility(View.VISIBLE);
                        }
                        else if(message.equals("error"))
                        {
                            Toast.makeText(getApplicationContext(),"Wrong User Name and Password",Toast.LENGTH_LONG).show();
                            loading.setVisibility(View.GONE);
                            lg_btn.setVisibility(View.VISIBLE);
                        }

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(login.this, error.toString(), Toast.LENGTH_LONG).show();
                        loading.setVisibility(View.GONE);
                        lg_btn.setVisibility(View.VISIBLE);
                    }
                }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("username", uname);
                params.put("Password", passwrod);
                return params;
            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
        requestQueue.add(stringRequest);
    }
}