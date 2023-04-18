import React from 'react'
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faYoutube } from "@fortawesome/free-brands-svg-icons";
import { faFacebook } from "@fortawesome/free-brands-svg-icons";
import { faTwitter } from "@fortawesome/free-brands-svg-icons";
import { faInstagram } from "@fortawesome/free-brands-svg-icons";
import { faTiktok } from "@fortawesome/free-brands-svg-icons";

function Footer(store) {
  const theStore = store['store']

  return (
    <footer>
      <p>تابعنا من خلال مواقع التواصل الاجتماعي</p>
      <div className='social-icons'>
        { theStore['youtube'] && theStore['youtube'] !== '' ? 
          <a href={theStore['youtube']} ><FontAwesomeIcon icon={faYoutube} color='white' /></a> : undefined}

        { theStore['facebook'] && theStore['facebook'] !== '' ? 
          <a href={theStore['facebook']} ><FontAwesomeIcon icon={faFacebook} color='white' /></a> : undefined}

        { theStore['twitter'] && theStore['twitter'] !== '' ? 
          <a href={theStore['twitter']} ><FontAwesomeIcon icon={faTwitter} color='white' /></a> : undefined}

        { theStore['instagram'] && theStore['instagram'] !== '' ? 
          <a href={theStore['instagram']} ><FontAwesomeIcon icon={faInstagram} color='white' /></a> : undefined}

        { theStore['tiktok'] && theStore['tiktok'] !== '' ? 
          <a href={theStore['tiktok']} ><FontAwesomeIcon icon={faTiktok} color='white' /></a> : undefined}
      </div>
      <p>&#xA9; 2023 أوتوجوتو جميع الحقوق محفوظة </p>


    </footer>
  )
}

export default Footer