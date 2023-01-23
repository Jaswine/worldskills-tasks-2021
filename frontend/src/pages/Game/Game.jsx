import React from 'react';
//Objects
import styles from './Game.module.scss';
import Igloo from '../../media/Game_assets/Object/Igloo.png';
import IceBox from '../../media/Game_assets/Object/IceBox.png';
import Crate from '../../media/Game_assets/Object/Crate.png';
import Crystal from '../../media/Game_assets/Object/Crystal.png';
import Sign_1 from '../../media/Game_assets/Object/Sign_1.png';
import Sign_2 from '../../media/Game_assets/Object/Sign_2.png';
import SnowMan from '../../media/Game_assets/Object/SnowMan.png';
import Stone from '../../media/Game_assets/Object/Stone.png';
import Tree_1 from '../../media/Game_assets/Object/Tree_1.png';
import Tree_2 from '../../media/Game_assets/Object/Tree_2.png';
//back
import One from '../../media/Game_assets/Tiles/1.png';
import Two from '../../media/Game_assets/Tiles/2.png';
import Three from '../../media/Game_assets/Tiles/3.png';
import Four from '../../media/Game_assets/Tiles/4.png';
import Five from '../../media/Game_assets/Tiles/5.png';
import Six from '../../media/Game_assets/Tiles/6.png';
import Seven from '../../media/Game_assets/Tiles/7.png';
import Eight from '../../media/Game_assets/Tiles/8.png';
import Nine from '../../media/Game_assets/Tiles/9.png';
import Ten from '../../media/Game_assets/Tiles/10.png';
import Eleven from '../../media/Game_assets/Tiles/11.png';
import Twelve from '../../media/Game_assets/Tiles/12.png';
import Thirteen from '../../media/Game_assets/Tiles/13.png';
import Fourteen from '../../media/Game_assets/Tiles/14.png';
import Fifteen from '../../media/Game_assets/Tiles/15.png';
import Sixteen from '../../media/Game_assets/Tiles/16.png';
import Seventeen from '../../media/Game_assets/Tiles/17.png';
import Eighteen from '../../media/Game_assets/Tiles/18.png';
import Snowman from '../../components/SnowMan/Snowman';

function Game() {
  return (
    <div className={styles.game}>
      <div className={`${styles.land1} ${styles.land2}`}>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        {/* <img src={Fourteen} alt="" /> */}
        <span></span>
        <span></span>
        <img src={IceBox} alt="" />

        <span></span>
        <span></span>
        <span></span>
        <img src={Crate} alt="" />
        <img src={Crate} alt="" />
        <span></span>
        <span></span>
      </div>
      <div className={`${styles.land1} ${styles.land2}`}>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>

        {/* <span></span> */}
        <img src={Fourteen} alt="" />
        <img src={Fifteen} alt="" />
        <img src={Sixteen} alt="" />
        <span></span>
        <img src={One} alt=" " />
        <img src={Two} alt=" " />
        <img src={Two} alt="" />
        <img src={Three} alt="" />
        <span></span>
      </div>
      <div className={`${styles.land1} ${styles.land2}`}>
        <img src={Two} alt="" />
        <img src={Two} alt="" />
        <img src={Two} alt="" />
        <img src={Two} alt="" />
        <img src={Two} alt="" />
        <img src={Three} alt="" />
        <img src={Stone} alt="" />
        <img src={Sign_2} alt="" />
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <img src={Four} alt=" " />
        <img src={Five} alt=" " />
        <img src={Five} alt="" />
        <img src={Six} alt="" />
        <span></span>
      </div>
      <div className={`${styles.land1} ${styles.land2}`}>
        <img src={Five} alt="" />
        <img src={Five} alt="" />
        <img src={Five} alt="" />
        <img src={Five} alt="" />
        <img src={Five} alt="" />
        <img src={Ten} alt="" />
        <img src={Eleven} alt="" />
        <img src={Three} alt="" />
        <img src={Seventeen} alt="" />
        <img src={Seventeen} alt="" />
        <img src={Seventeen} alt="" />
        <img src={Seventeen} alt="" />
        <img src={One} alt="" />
        <img src={Two} alt="" />
        <img src={Two} alt="" />
        <img src={Two} alt="" />
        <img src={Two} alt="" />
        <img src={Two} alt="" />
      </div>
      <div className={styles.land1}>
        <img src={Five} alt="" />
        <img src={Five} alt="" />
        <img src={Five} alt="" />
        <img src={Five} alt="" />
        <img src={Five} alt="" />
        <img src={Five} alt="" />
        <img src={Five} alt="" />
        <img src={Six} alt="" />
        <img src={Eighteen} alt="" />
        <img src={Eighteen} alt="" />
        <img src={Eighteen} alt="" />
        <img src={Eighteen} alt="" />
        <img src={Four} alt="" />
        <img src={Five} alt="" />
        <img src={Five} alt="" />
        <img src={Five} alt="" />
        <img src={Five} alt="" />
        <img src={Five} alt="" />
      </div>
    </div>
  )
}

export default Game