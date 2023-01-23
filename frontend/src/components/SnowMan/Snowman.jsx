import React from 'react';
import styles from './Snowman.module.scss';
import snowman from '../../media/Game_assets/Snowman/snowman.svg'

function Snowman() {
  return (
    <img src={snowman} alt="" className={styles.snowman} />
  )
}

export default Snowman