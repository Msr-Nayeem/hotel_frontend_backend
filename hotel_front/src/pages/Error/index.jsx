import styles from './../Error/Error.module.css';
function Error(){
    document.title="404 Error";
    return(
    <div id={styles.notfound}>
        <div className={styles.notfound}>
        <div className={styles.notfound-404} />
        <h1>404</h1>
        <h2>Oops! Page Not Be Found</h2>
        <p>
            Sorry but the page you are looking for does not exist, have been
            removed. name changed or is temporarily unavailable
        </p>
        </div>
    </div>
    )
}
export default Error;