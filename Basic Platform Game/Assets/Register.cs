using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.SceneManagement;

public class Register : MonoBehaviour
{
    [SerializeField] InputField Username;
    [SerializeField] InputField Password;
    [SerializeField] InputField RepeatPassword;
    [SerializeField] Button Submit;
    void Start()
    {
        Submit.onClick.AddListener(() =>
        {
            StartCoroutine(Main.main.web.Register(Username.text, Password.text, RepeatPassword.text));
        });
    }
}
