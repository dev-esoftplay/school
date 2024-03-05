// noPage

import { LibCrypt } from 'esoftplay/cache/lib/crypt/import';
import { UserClass } from 'esoftplay/cache/user/class/import';
import esp from 'esoftplay/esp';
import LibCurl from 'esoftplay/modules/lib/curl';


export default class m extends LibCurl {

  async setHeader(): Promise<void> {
    const config = esp.config();
    const crypt = new LibCrypt()
<<<<<<< HEAD
    if ((/:\/\/data.*?\/(.*)/g).test(this.url)) {
      this.header['masterkey'] = crypt.encode(this.url)
    }
    let dt = UserClass.state().get()
    let token = this.getTimeByTimeZone(config.timezone) + ''
    // let token =  dt.id
    if (data) {
      //   this.setApiKey(dt.id)
      token += "|" + apikey
      console.log("time", this.getTimeByTimeZone(config.timezone))
      console.log("apikey :", apikey)
      console.log("token => time|apikey:", this.getTimeByTimeZone(config.timezone) + "|" + apikey)
      console.log("token :",crypt.encode(token))
      
=======
    let token = String(this.getTimeByTimeZone(config.timezone))
    const data = UserClass.state().get()
    if (data) {
      token += "|" + String(data.apikey)
>>>>>>> eb3dd804f2fcd0e1d0b005f7645de012a1dedde8
    } else {
      token += "|" + 0
    }
    console.log('test hit api:',{ apikey: data?.apikey, uri: this.url + this.uri, token })
    console.log( 'token yang sudah di encode:', crypt.encode(token))
    this.header['token'] = crypt.encode(token)
  }
}
