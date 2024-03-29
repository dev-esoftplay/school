// withHooks
import { LibList } from 'esoftplay/cache/lib/list/import';
import { LibNotification } from 'esoftplay/cache/lib/notification/import';
import { UserNotification } from 'esoftplay/cache/user/notification/import';
import esp from 'esoftplay/esp';
import { useEffect } from 'react';

import React from 'react';
import { Pressable, Text, View } from 'react-native';
import moment from 'esoftplay/moment';
import { LibStyle } from 'esoftplay/cache/lib/style/import';


export interface TeacherNotifArgs {

}
export interface TeacherNotifProps {

}
function m(props: TeacherNotifProps): any {

  let notifs = UserNotification.state().useSelector(s => s.data);

  const formattedDate = moment('2024-03-13 08:52:12').format('dddd, DD MMMM YYYY HH:mm:');
  
  console.log(formattedDate); // Output: Rabu, 13 Maret 2024 08:52:12
  

  useEffect(() => {

    LibNotification.loadData(true)
    esp.log(notifs);
    console.log("notif", notifs);
    // console.log("notif", notifs[0]?.updated);

  }, [])

  function shadows(value: number) {
    return {
      elevation: 3, // For Android
      shadowColor: '#000', // For iOS
      shadowOffset: { width: 1, height: 5 },
      shadowOpacity: 0.7,
      shadowRadius: value,
    }
  }
  return (
    <View style={{ flex: 1, backgroundColor: 'white', padding: 10,marginTop:LibStyle.STATUSBAR_HEIGHT }}>
        <Text style={{ fontSize: 24, fontWeight: 'bold', marginBottom: 30, marginLeft: 10, }}>Notifikasi</Text>
      <LibList data={notifs}
        onRefresh={() => LibNotification.loadData(true)}
        keyExtractor={(item, index) => index.toString()}

        renderItem={(item: any) => {
          // console.log("item", item?.title)
          return (
            <Pressable onPress={()=>LibNotification.openNotif(item)} style={{ height: 'auto', backgroundColor: 'white', padding: 10, ...shadows(7), borderRadius: 12, marginHorizontal: 10, marginVertical: 10 }}>
              <View style={{ marginBottom: 10, justifyContent: 'space-between', flex: 1 }}>
               <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
               <Text style={{ fontSize: 16, fontWeight: 'bold', marginBottom: 10 }}>{item?.title ?? 'tittle'}</Text>
             
               
                </View>

                <Text style={{ fontSize: 14, fontWeight: '600' }}>{item?.message}</Text>
              </View>

              <Text style={{ fontSize: 12, color: 'gray' }}>{moment(item?.updated).format('dddd, DD MMMM YYYY HH:mm')}</Text>
              {/* <Text style={{ fontSize: 12, color: 'gray' }}>{item?.params}</Text> */}
            </Pressable>
          )
        }
        }
      />
    </View>
  )
}
export default m;