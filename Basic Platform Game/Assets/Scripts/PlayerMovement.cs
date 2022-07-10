using UnityEngine;

public class PlayerMovement : MonoBehaviour
{
    [SerializeField] private Rigidbody2D rb2d;
    [SerializeField] private SpriteRenderer sprite;
    [SerializeField] private Animator anim;
    [SerializeField] private float speed;
    [SerializeField] private float jumpForce;
    [SerializeField] private bool isGrounded;

    private void Awake()
    {
        rb2d = GetComponent<Rigidbody2D>();
        sprite = GetComponent<SpriteRenderer>();
        anim = GetComponent<Animator>();
    }

    private void FixedUpdate()
    {
        float horizontalInput = Input.GetAxis("Horizontal");

        rb2d.velocity = new Vector2
        {
            x = horizontalInput * speed,
            y = rb2d.velocity.y
        };

        anim.SetBool("Run", horizontalInput != 0);

        if (horizontalInput != 0)
        {
            sprite.flipX = horizontalInput < 0;
        }

        if (isGrounded && Input.GetKey(KeyCode.Space))
        {
            rb2d.velocity = new Vector2
            {
                x = rb2d.velocity.x,
                y = jumpForce
            };
        }
    }

    private void OnCollisionEnter2D(Collision2D collision)
    {
        if(collision.gameObject.CompareTag("Platform"))
        {
            isGrounded = true;
            anim.SetBool("Jump", false);
        }
    }

    private void OnCollisionExit2D(Collision2D collision)
    {
        if (collision.gameObject.CompareTag("Platform"))
        {
            isGrounded = false;
            anim.SetBool("Jump", true);
        }
    }
}
