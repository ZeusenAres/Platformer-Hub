using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class Main : MonoBehaviour
{
    public static Main main;
    public Web web;

    void Start()
    {
        main = this;
        web = GetComponent<Web>();
    }
}
