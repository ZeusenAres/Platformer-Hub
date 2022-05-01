using System.Collections;
using UnityEngine;
using UnityEngine.Networking;
using UnityEngine.SceneManagement;

public class Web : MonoBehaviour
{
    // Start is called before the first frame update
    [System.Obsolete]
    void Start()
    {
        StartCoroutine(Connection());
    }

    [System.Obsolete]
    IEnumerator Connection()
    {
        using (UnityWebRequest www = UnityWebRequest.Get("http://localhost/GameDev/PlatformHub/PlatformHub/message.php"))
        {
            yield return www.Send();

            if (www.isNetworkError || www.isHttpError)
            {
                Debug.Log(www.error);
            }
            else
            {
                // Show results as text
                Debug.Log(www.downloadHandler.text);

                // Or retrieve results as binary data
                byte[] results = www.downloadHandler.data;
            }
        }
    }

    public IEnumerator Login(string username, string password)
    {
        WWWForm form = new WWWForm();
        form.AddField("username", username);
        form.AddField("password", password);

        using (UnityWebRequest www = UnityWebRequest.Post("http://localhost/GameDev/PlatformHub/PlatformHub/loginbackend.php", form))
        {
            yield return www.SendWebRequest();

            if (www.result != UnityWebRequest.Result.Success)
            {
                Debug.Log(www.error);
            }
            else
            {
                string message = www.downloadHandler.text;

                if (message.Contains("welcome") == true)
                {
                    SceneManager.LoadScene("Level");
                }
                else
                {
                    Debug.Log(message);
                }
            }
        }
    }

    public IEnumerator Register(string username, string password, string repeatedPassword)
    {
        WWWForm form = new WWWForm();
        form.AddField("username", username);
        form.AddField("password", password);
        form.AddField("repeatedpassword", repeatedPassword);

        using (UnityWebRequest www = UnityWebRequest.Post("http://localhost/GameDev/PlatformHub/PlatformHub/registerbackend.php", form))
        {
            yield return www.SendWebRequest();

            if (www.result != UnityWebRequest.Result.Success)
            {
                Debug.Log(www.error);
            }
            else
            {
                string message = www.downloadHandler.text;
                
                if(message.Contains("created") == true)
                {
                    SceneManager.LoadScene("Login");
                }
            }
        }
    }
}
