// withHooks
import { memo } from 'react';

import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { LibList } from 'esoftplay/cache/lib/list/import';
import { LibNotification } from 'esoftplay/cache/lib/notification/import';
import { UserNotification } from 'esoftplay/cache/user/notification/import';
import esp from 'esoftplay/esp';
import React, { useEffect } from 'react';
import { FlatList, Text, View } from 'react-native';
import SchoolColors from '../utils/schoolcolor';


export interface ParentNotifArgs {
  
}
export interface ParentNotifProps {
  
}
function m(props: ParentNotifProps): any {
  let notifs = UserNotification.state().useSelector(s => s.data);
  useEffect(() => {

    // LibNotification.loadData(true)
    // esp.log(notifs);
    console.log("notif", notifs);
    // console.log("notif", notifs[0]?.updated);

  }, [])
  const notif = [
    {
      "tittle": "Rapat Guru",
      "message": "Selamat pagi Bapa/Ibu Guru. Hari ini ada rapat guru di ruang guru. Terima kasih.",
      "status": "Pengumuman",
    },
    {
      "tittle": "Gibran Rakabuming Raka",
      "message": "Selamat pagi, Pak. Saya izin tidak masuk sekolah hari ini karena sedang sakit. Terima kasih.",
      "kelas": " | XII IPA 1",
      "status": "ijin Sakit",

    },
    {
      "tittle": "Prabowo Subianto",
      "message": "Selamat pagi, Pak. Saya izin tidak masuk sekolah hari ini karena sedang sakit. Terima kasih.",
      "kelas": " | XII IPA 1",
      "status": "ijin Sakit",

    },
    {
      "tittle": "Muhaimin Iskandar",
      "message": "Selamat pagi, Pak. Saya izin tidak masuk sekolah hari ini kerena ikut pengajian. Terima kasih.",
      "kelas": " |  | XII IPA 1",
      "status": "ijin Sakit",

    },

  ];

  function shadows(value: number) {
    return {
      elevation: 3, // For Android
      shadowColor: '#000', // For iOS
      shadowOffset: { width: 1, height: 5 },
      shadowOpacity: 0.7,
      shadowRadius: value,
    }
  }
  const school= new SchoolColors()
  return (
    <View style={{ flex: 1, backgroundColor: 'white', padding: 10, }}>
      <View style={{}} >
        <Text style={{ fontSize: 24, fontWeight: 'bold', marginLeft: 10, marginTop: 40 }}>Notifikasi</Text>
      </View>

      <LibList data={notifs}
        onRefresh={() => LibNotification.loadData(true)}
        keyExtractor={(item, index) => index.toString()}

        renderItem={(item: any, index: number) => {
          // console.log("item", item?.title)
          return (
            <View style={{ height: 'auto', backgroundColor: 'white', padding: 10, ...shadows(7), borderRadius: 12, marginHorizontal: 10, marginVertical: 10 }}>
              <View style={{ marginBottom: 10, justifyContent: 'space-between', flex: 1 }}>
               <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
               <Text style={{ fontSize: 16, fontWeight: 'bold', marginBottom: 10 }}>{item?.title ?? 'tittle'}</Text>
             
               <LibIcon.Ionicons name="notifications" size={25} color='#4B7AD6' />
                </View>

                <Text style={{ fontSize: 14, fontWeight: '600' }}>{item?.message}</Text>
              </View>

              <Text style={{ fontSize: 12, color: 'gray' }}>{item?.updated}</Text>

            </View>
          )
        }
        }
      />
    </View>
  )
}

export default memo(m);