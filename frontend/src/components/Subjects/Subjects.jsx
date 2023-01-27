import React from 'react';
import style from './Subjects.module.scss';
//Objects
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

function Subjects() {
  return (
    <div className={style.subjects}>
      <div className={style.subjects__in}>
        <img src={Tree_1} className={style.trees1}/>
        <img src={Tree_1} className={style.trees2}/>
        <img src={Igloo} alt="" className={style.Igloo}/>
        <img src={Tree_2} className={style.tree1}/>
        <img src={Tree_2} className={style.tree2}/>
        <img src={Tree_2} className={style.tree3}/>
        <img src={SnowMan} alt="" className={style.snowMan1} />
        <img src={Sign_1} className={style.sign_1}/>
        <img src={Sign_1} className={style.sign_2}/>
        <img src={Crystal} className={style.crystal1}/>
        <img src={Crystal} className={style.crystal2}/>
        
        <img src={IceBox} className={style.IceBox1}/>
        <img src={IceBox} className={style.IceBox2}/>
        <img src={IceBox} className={style.IceBox3}/>

        <img src={Crate} className={style.Crate1}/>
        <img src={Crate} className={style.Crate2}/>
        <img src={Crate} className={style.Crate3}/>

        <img src={Stone} className={style.Stone}/>
      </div>
    </div>
  )
}

export default Subjects