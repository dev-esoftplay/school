// withHooks
import { memo } from 'react';

import { useState, useEffect } from 'react';
import { Text, View, FlatList } from 'react-native';

import { LibStyle } from 'esoftplay/cache/lib/style/import';
import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import SchoolColors from './schoolcolor';

export interface TestArgs {

}
export interface TestProps {

}



function m(props: TestProps): any {

  const[teacherSchadule, setTeacherSchadule] = useState<any>([])
  const[allDays, setAllDays] = useState<any>([])
  useEffect(() => {
    new LibCurl('teacher_schedule_class', 'get', (result, msg) => { 
      console.log('Jadwal Result:', result);
      setTeacherSchadule(result.schedules)
      setAllDays(result.days)
    }, (error) => { 
      console.log('error:', error);
    })
  }, [])
  const school = new SchoolColors();
  const renderScheduleItem = ({ item }: { item: any }) => (
    console.log('item', item),
    <View style={{ marginBottom: 20, width: '100%', padding: 5 }}>
      {/* <Text style={{ fontSize: 20, fontWeight: 'bold', color: '#000000' }}>{item.day}</Text> */}
      <FlatList
        data={item.schedule}
        keyExtractor={(scheduleItem: any) => scheduleItem.schedule_id}
        renderItem={({ item: schedule }: { item: any }) => (
          console.log('schedule', schedule),
          <View key={schedule.schedule_id} style={{ flexDirection: 'row', backgroundColor: '#e7e7e7', borderRadius: 10, marginBottom: 10, height: 100,  }}>
            {/* You can customize this part according to your schedule data */}
            <View style={{ marginRight: 10, width: 20, backgroundColor: school.primary, borderBottomLeftRadius: 10, borderTopLeftRadius: 10 }} >

            </View>
            <View style={{ justifyContent: 'center', padding: 10 }}>
              <Text style={{ fontSize: 16, color: '#555' }}>{schedule.course.name}</Text>
              <View style={{ flex: 1 }} />
              <Text style={{ fontSize: 16, color: '#555' }}>{schedule.clock_start} - {schedule.clock_end}</Text>

            </View>
          </View>
        )}
      />
    </View>
  );

  console.log('allDays :',allDays);
  var schadulefilter = teacherSchadule.filter((item: { day: string; }) => item.day === 'senin')
  console.log('schadulefilter :',schadulefilter);
  return (
    <View style={{ flex: 1, backgroundColor: 'white', padding: 10, marginTop: LibStyle.STATUSBAR_HEIGHT }}>
      <Text>Test</Text>
      {allDays.map((item: any, index: number) => {
         return (
          <Text key={index}>{item}</Text>
        );
      })}
          <FlatList
            data={schadulefilter}
            scrollEnabled={true}
            keyExtractor={(_item, index) => index.toString()}
            contentContainerStyle={{ width: '100%' }}
            renderItem={renderScheduleItem}
          />
       

    </View>
  );
}

export default memo(m);