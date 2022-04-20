using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.SceneManagement;

public class MoveToScene : MonoBehaviour
{
    [SerializeField] Button Link;

    public void goToScene(string scene)
    {
        Link.onClick.AddListener(() =>
        {
            SceneManager.LoadScene(scene);
        });
    }
}
