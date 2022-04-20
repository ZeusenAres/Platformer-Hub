using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class Login : MonoBehaviour
{
    [SerializeField] InputField Username;
    [SerializeField] InputField Password;
    [SerializeField] Button Submit;
    void Start()
    {
        Submit.onClick.AddListener(() =>
        {
            StartCoroutine(Main.main.web.Login(Username.text, Password.text));
        });
    }
}
