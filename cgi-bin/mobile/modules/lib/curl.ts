// noPage

import { LibCrypt } from 'esoftplay/cache/lib/crypt/import';
import { UserClass } from 'esoftplay/cache/user/class/import';
import esp from 'esoftplay/esp';
import LibCurl from 'esoftplay/modules/lib/curl';


export default class m extends LibCurl {

  async setHeader(): Promise<void> {
    const config = esp.config();
    const crypt = new LibCrypt()
    let token = String(this.getTimeByTimeZone(config.timezone))
    const data = UserClass.state().get()
    if (data) {
      token += "|" + String(data.apikey)
    } else {
      token += "|" + 0
    }
    console.log({ apikey: data?.apikey, uri: this.url + this.uri, token })
    this.header['token'] = crypt.encode(token)
  }
}
